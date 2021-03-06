<?php
namespace gms\system\cache\builder;
use wcf\data\option\category\OptionCategory;
use wcf\system\cache\builder\OptionCacheBuilder;
use wcf\system\database\util\PreparedStatementConditionBuilder;
use wcf\system\WCF;

/**
 * Caches options and option categories for guilds
 */
class GuildOptionCacheBuilder extends OptionCacheBuilder {
	/**
	 * option class name
	 * @var	string
	 */
	protected $optionClassName = 'gms\data\guild\option\GuildOption';
	
	/**
	 * database table name
	 * @var	string
	 */
	protected $tableName = 'guild_option';

	/**
	 * @see	\wcf\system\cache\builder\AbstractCacheBuilder::rebuild()
	 */
	public function rebuild(array $parameters) {
		$data = array(
			'categories' => array(),
			'options' => array(),
			'categoryStructure' => array(),
			'optionToCategories' => array()
		);

		// option categories
		// get all option categories and sort categories by priority
		$sql = "SELECT	categoryName, categoryID
			FROM	gms".WCF_N."_".$this->tableName."_category";
		$statement = WCF::getDB()->prepareStatement($sql);
		$statement->execute();
		$optionCategories = array();
		while ($row = $statement->fetchArray()) {
			$optionCategories[$row['categoryName']] = $row['categoryID'];
		}

		if (!empty($optionCategories)) {
			// get needed option categories
			$conditions = new PreparedStatementConditionBuilder();
			$conditions->add("categoryID IN (?)", array($optionCategories));

			$sql = "SELECT		option_category.*, package.packageDir
				FROM		gms".WCF_N."_".$this->tableName."_category option_category
				LEFT JOIN	wcf".WCF_N."_package package
				ON		(package.packageID = option_category.packageID)
				".$conditions."
				ORDER BY	showOrder ASC";
			$statement = WCF::getDB()->prepareStatement($sql);
			$statement->execute($conditions->getParameters());
			while ($row = $statement->fetchArray()) {
				$data['categories'][$row['categoryName']] = new OptionCategory(null, $row);
				if (!isset($data['categoryStructure'][$row['parentCategoryName']])) {
					$data['categoryStructure'][$row['parentCategoryName']] = array();
				}

				$data['categoryStructure'][$row['parentCategoryName']][] = $row['categoryName'];
			}
		}

		// options
		// get all options and sort options by priority
		$optionIDs = array();
		$sql = "SELECT		optionName, optionID
			FROM		gms".WCF_N."_".$this->tableName;
		$statement = WCF::getDB()->prepareStatement($sql);
		$statement->execute();
		while ($row = $statement->fetchArray()) {
			$optionIDs[$row['optionName']] = $row['optionID'];
		}

		if (!empty($optionIDs)) {
			// get needed options
			$conditions = new PreparedStatementConditionBuilder();
			$conditions->add("optionID IN (?)", array($optionIDs));

			$sql = "SELECT		*
				FROM		gms".WCF_N."_".$this->tableName."
				".$conditions."
				ORDER BY	showOrder ASC";
			$statement = WCF::getDB()->prepareStatement($sql);
			$statement->execute($conditions->getParameters());
			$optionClassName = $this->optionClassName;
			while ($row = $statement->fetchArray()) {
				$data['options'][$row['optionName']] = new $optionClassName(null, $row);
				if (!isset($data['optionToCategories'][$row['categoryName']])) {
					$data['optionToCategories'][$row['categoryName']] = array();
				}

				$data['optionToCategories'][$row['categoryName']][] = $row['optionName'];
			}
		}

		return $data;
	}
}
