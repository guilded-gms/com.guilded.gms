<?php
namespace gms\system\package\plugin;
use wcf\system\package\plugin\AbstractXMLPackageInstallationPlugin;
use wcf\system\WCF;

/**
 * Installs, updates and deletes character profile menu items.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2013 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	system.package.plugin
 * @category	Guilded 2.0
 */
class CharacterProfileMenuPackageInstallationPlugin extends AbstractXMLPackageInstallationPlugin {
	/**
	 * @see	\wcf\system\package\plugin\AbstractXMLPackageInstallationPlugin::$className
	 */
	public $className = 'gms\data\character\profile\menu\item\CharacterProfileMenuItemEditor';

	/**
	 * @see	\wcf\system\package\plugin\AbstractPackageInstallationPlugin::$application
	 */
	public $application = 'gms';

	/**
	 * @see	\wcf\system\package\plugin\AbstractPackageInstallationPlugin::$tableName
	 */
	public $tableName = 'character_profile_menu_item';
	
	/**
	 * @see	\wcf\system\package\plugin\AbstractXMLPackageInstallationPlugin::$tagName
	 */
	public $tagName = 'characterprofilemenuitem';
	
	/**
	 * @see	\wcf\system\package\plugin\AbstractXMLPackageInstallationPlugin::handleDelete()
	 */
	protected function handleDelete(array $items) {
		$sql = "DELETE FROM	gms".WCF_N."_".$this->tableName."
			WHERE		menuItem = ?
					AND packageID = ?";
		$statement = WCF::getDB()->prepareStatement($sql);
		foreach ($items as $item) {
			$statement->execute(array(
				$item['attributes']['name'],
				$this->installation->getPackageID()
			));
		}
	}
	
	/**
	 * @see	\wcf\system\package\plugin\AbstractXMLPackageInstallationPlugin::prepareImport()
	 */
	protected function prepareImport(array $data) {
		// adjust show order
		$showOrder = (isset($data['elements']['showorder'])) ? $data['elements']['showorder'] : null;
		$showOrder = $this->getShowOrder($showOrder);
		
		// merge values and default values
		return array(
			'menuItem' => $data['attributes']['name'],
			'options' => (isset($data['elements']['options'])) ? $data['elements']['options'] : '',
			'permissions' => (isset($data['elements']['permissions'])) ? $data['elements']['permissions'] : '',
			'showOrder' => $showOrder,
			'className' => $data['elements']['classname']
		);
	}
	
	/**
	 * @see	\wcf\system\package\plugin\AbstractXMLPackageInstallationPlugin::findExistingItem()
	 */
	protected function findExistingItem(array $data) {
		$sql = "SELECT	*
			FROM	gms".WCF_N."_".$this->tableName."
			WHERE	menuItem = ?
				AND packageID = ?";
		$parameters = array(
			$data['menuItem'],
			$this->installation->getPackageID()
		);
		
		return array(
			'sql' => $sql,
			'parameters' => $parameters
		);
	}
}
