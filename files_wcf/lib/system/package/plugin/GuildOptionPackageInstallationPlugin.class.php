<?php
namespace wcf\system\package\plugin;
use gms\data\guild\option\category\GuildOptionCategory;
use gms\data\guild\option\category\GuildOptionCategoryEditor;
use gms\data\guild\option\GuildOption;
use gms\data\guild\option\GuildOptionEditor;
use wcf\system\exception\SystemException;
use wcf\system\package\plugin\AbstractOptionPackageInstallationPlugin;
use wcf\system\package\plugin\AbstractXMLPackageInstallationPlugin;
use wcf\system\WCF;
use wcf\util\StringUtil;

/**
 * Package-installation-plugin implementation for guild option.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	system.package.plugin
 * @category	Guilded 2.0
 */
class GuildOptionPackageInstallationPlugin extends AbstractOptionPackageInstallationPlugin {
	/**
	 * @see	\wcf\system\package\plugin\AbstractPackageInstallationPlugin::$tableName
	 */
	public $tableName = 'guild_option';

	/**
	 * @see	\wcf\system\package\plugin\AbstractPackageInstallationPlugin::$application
	 */
	public $application = 'gms';
	
	/**
	 * list of names of tags which are not considered as additional data
	 * @var	array<string>
	 */
	public static $reservedTags = array('name', 'optiontype', 'defaultvalue', 'validationpattern', 'required', 'showorder', 'outputclass', 'selectoptions', 'enableoptions', 'disabled', 'categoryname', 'permissions', 'options', 'attrs', 'cdata');

	/**
	 * @see	\wcf\system\package\plugin\AbstractXMLPackageInstallationPlugin::deleteItems()
	 */
	protected function deleteItems(\DOMXPath $xpath) {
		// delete options
		$elements = $xpath->query('/ns:data/ns:delete/ns:option');
		$options = array();
		foreach ($elements as $element) {
			$options[] = $element->getAttribute('name');
		}

		if (!empty($options)) {
			$sql = "DELETE FROM	gms".WCF_N."_".$this->tableName."
					WHERE	optionName = ? AND
							packageID = ?";
			$statement = WCF::getDB()->prepareStatement($sql);

			foreach ($options as $option) {
				$statement->execute(array(
					$option,
					$this->installation->getPackageID()
				));
			}
		}

		// delete categories
		$elements = $xpath->query('/ns:data/ns:delete/ns:optioncategory');
		$categories = array();
		foreach ($elements as $element) {
			$categories[] = $element->getAttribute('name');
		}

		if (!empty($categories)) {
			// delete options for given categories
			$sql = "DELETE FROM	gms".WCF_N."_".$this->tableName."
					WHERE	categoryName = ?";
			$statement = WCF::getDB()->prepareStatement($sql);
			foreach ($categories as $category) {
				$statement->execute(array($category));
			}

			// delete categories
			$sql = "DELETE FROM	wcf".WCF_N."_".$this->tableName."_category
					WHERE	categoryName = ? AND
							packageID = ?";
			$statement = WCF::getDB()->prepareStatement($sql);

			foreach ($categories as $category) {
				$statement->execute(array(
					$category,
					$this->installation->getPackageID()
				));
			}
		}
	}

	/**
	 * @see	\wcf\system\package\plugin\AbstractXMLPackageInstallationPlugin::importCategories()
	 */
	protected function importCategories(\DOMXPath $xpath) {
		$elements = $xpath->query('/ns:data/ns:import/ns:categories/ns:category');
		foreach ($elements as $element) {
			$data = array();

			// get child elements
			$children = $xpath->query('child::*', $element);
			foreach ($children as $child) {
				$data[$child->tagName] = $child->nodeValue;
			}

			// build data block with defaults
			$data = array(
				'categoryName' => $element->getAttribute('name'),
				'options' => (isset($data['options'])) ? $data['options'] : '',
				'parentCategoryName' => (isset($data['parent'])) ? $data['parent'] : '',
				'permissions' => (isset($data['permissions'])) ? $data['permissions'] : '',
				'showOrder' => (isset($data['showorder'])) ? intval($data['showorder']) : null
			);

			// adjust show order
			if ($data['showOrder'] !== null || $this->installation->getAction() != 'update') {
				$data['showOrder'] = $this->getShowOrder($data['showOrder'], $data['parentCategoryName'], 'parentCategoryName', '_category');
			}

			// validate parent
			if (!empty($data['parentCategoryName'])) {
				$sql = "SELECT	COUNT(categoryID) AS count
					FROM	gms".WCF_N."_".$this->tableName."_category
					WHERE	categoryName = ?";
				$statement = WCF::getDB()->prepareStatement($sql);
				$statement->execute(array($data['parentCategoryName']));
				$row = $statement->fetchArray();

				if (!$row['count']) {
					throw new SystemException("Unable to find parent 'option category' with name '".$data['parentCategoryName']."' for category with name '".$data['categoryName']."'.");
				}
			}

			// save category
			$this->saveCategory($data);
		}
	}

	/**
	 * @see	\wcf\system\package\plugin\IPackageInstallationPlugin::hasUninstall()
	 */
	public function hasUninstall() {
		$hasUninstallOptions = parent::hasUninstall();
		$sql = "SELECT	COUNT(categoryID) AS count
			FROM	gms".WCF_N."_".$this->tableName."_category
			WHERE	packageID = ?";
		$statement = WCF::getDB()->prepareStatement($sql);
		$statement->execute(array($this->installation->getPackageID()));
		$categoryCount = $statement->fetchArray();
		return ($hasUninstallOptions || $categoryCount['count'] > 0);
	}

	/**
	 * @see	\wcf\system\package\plugin\AbstractOptionPackageInstallationPlugin::saveCategory()
	 */
	protected function saveCategory($category, $categoryXML = null) {
		// use for create and update
		$data = array(
			'parentCategoryName' => $category['parentCategoryName'],
			'permissions' => $category['permissions'],
			'options' => $category['options']
		);
		// append show order if explicitly stated
		if ($category['showOrder'] !== null) $data['showOrder'] = $category['showOrder'];
		
		$guildOptionCategory = GuildOptionCategory::getCategoryByName($category['categoryName'], $this->installation->getPackageID());
		if ($guildOptionCategory->categoryID) {
			$categoryEditor = new GuildOptionCategoryEditor($guildOptionCategory);
			$categoryEditor->update($data);
		}
		else {
			// append data fields for create
			$data['packageID'] = $this->installation->getPackageID();
			$data['categoryName'] = $category['categoryName'];
			
			GuildOptionCategoryEditor::create($data);
		}
	}
	
	/**
	 * @see	\wcf\system\package\plugin\AbstractOptionPackageInstallationPlugin::saveOption()
	 */
	protected function saveOption($option, $categoryName, $existingOptionID = 0) {
		// default values
		$optionName = $optionType = $validationPattern = $outputClass = $selectOptions = $enableOptions = $permissions = $options = '';
		$required = $disabled = 0;
		$defaultValue = $showOrder = null;
		
		// get values
		if (isset($option['name'])) $optionName = $option['name'];
		if (isset($option['optiontype'])) $optionType = $option['optiontype'];
		if (isset($option['defaultvalue'])) $defaultValue = $option['defaultvalue'];
		if (isset($option['validationpattern'])) $validationPattern = $option['validationpattern'];
		if (isset($option['required'])) $required = intval($option['required']);
		if (isset($option['showorder'])) $showOrder = intval($option['showorder']);
		if (isset($option['outputclass'])) $outputClass = $option['outputclass'];
		if (isset($option['selectoptions'])) $selectOptions = $option['selectoptions'];
		if (isset($option['enableoptions'])) $enableOptions = $option['enableoptions'];
		if (isset($option['disabled'])) $disabled = intval($option['disabled']);
		$showOrder = $this->getShowOrder($showOrder, $categoryName, 'categoryName');
		if (isset($option['permissions'])) $permissions = $option['permissions'];
		if (isset($option['options'])) $options = $option['options'];

		// check if optionType exists
		$className = 'wcf\system\option\\'.StringUtil::firstCharToUpperCase($optionType).'OptionType';
		if (!class_exists($className)) {
			$className = 'gms\system\option\\'.StringUtil::firstCharToUpperCase($optionType).'OptionType';
			if (!class_exists($className)) {
				throw new SystemException("unable to find class '".$className."'");
			}
		}
		
		// collect additional tags and their values
		$additionalData = array();
		foreach ($option as $tag => $value) {
			if (!in_array($tag, self::$reservedTags)) $additionalData[$tag] = $value;
		}
		
		// get optionID if it was installed by this package already
		$sql = "SELECT	*
			FROM	gms".WCF_N."_".$this->tableName."
			WHERE	optionName = ?
			AND	packageID = ?";
		$statement = WCF::getDB()->prepareStatement($sql);
		$statement->execute(array(
			$optionName,
			$this->installation->getPackageID()
		));
		$result = $statement->fetchArray();
		
		// build data array
		$data = array(
			'categoryName' => $categoryName,
			'optionType' => $optionType,
			'defaultValue' => $defaultValue,
			'validationPattern' => $validationPattern,
			'selectOptions' => $selectOptions,
			'enableOptions' => $enableOptions,
			'required' => $required,		
			'outputClass' => $outputClass,
			'showOrder' => $showOrder,
			'disabled' => $disabled,
			'permissions' => $permissions,
			'options' => $options,
			'additionalData' => serialize($additionalData)
		);
		
		// update option
		if (!empty($result['optionID']) && $this->installation->getAction() == 'update') {
			$guildOption = new GuildOption(null, $result);
			$guildOptionEditor = new GuildOptionEditor($guildOption);
			$guildOptionEditor->update($data);
		}
		// insert new option
		else {
			// append option name
			$data['optionName'] = $optionName;
			$data['packageID'] = $this->installation->getPackageID();
			GuildOptionEditor::create($data);
		}
	}

	/**
	 * @see	\wcf\system\package\plugin\IPackageInstallationPlugin::uninstall()
	 */
	public function uninstall() {
		// delete options
		AbstractXMLPackageInstallationPlugin::uninstall();

		// delete categories
		$sql = "DELETE FROM	gms".WCF_N."_".$this->tableName."_category
			WHERE		packageID = ?";
		$statement = WCF::getDB()->prepareStatement($sql);
		$statement->execute(array($this->installation->getPackageID()));
	}
}
