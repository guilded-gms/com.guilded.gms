<?php
namespace gms\data\character\option\category;
use gms\data\character\option\CharacterOption;
use gms\data\GMSDatabaseObject;
use wcf\system\WCF;

/**
 * Represents a CharacterOptionCategory.
 * 
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	data.character.option.category
 * @category	Guilded 2.0
 */
class CharacterOptionCategory extends GMSDatabaseObject {
	/**
	 * @see	\wcf\data\DatabaseObject::$databaseTableName
	 */
	protected static $databaseTableName = 'character_option_category';
	
	/**
	 * @see	\wcf\data\DatabaseObject::$databaseTableIndexName
	 */
	protected static $databaseTableIndexName = 'categoryID';
	
	/**
	 * @see	\wcf\data\DatabaseObject::__construct()
	 */
	public function __construct($categoryID, $row = null, CharacterOptionCategory $category = null) {
		if ($categoryID !== null) {
			$sql = "SELECT	character_option_category.*,
					(SELECT COUNT(DISTINCT optionName) FROM ".CharacterOption::getDatabaseTableName()." WHERE categoryName = character_option_category.categoryName) AS options
				FROM	".static::getDatabaseTableName()." character_option_category
				WHERE	character_option_category.categoryID = ?";
			$statement = WCF::getDB()->prepareStatement($sql);
			$statement->execute(array($categoryID));
			$row = $statement->fetchArray();
		}
		
		parent::__construct(null, $row, $category);
	}
	
	/**
	 * Returns the title of this category.
	 * 
	 * @return	string
	 */
	public function __toString() {
		return $this->categoryName;
	}
	
	/**
	 * Returns an instance of CharacterOptionCategory by name and package id.
	 * 
	 * @param	string		$categoryName
	 * @param	integer		$packageID
	 * @return	\gms\data\character\option\category\CharacterOptionCategory
	 */
	public static function getCategoryByName($categoryName, $packageID) {
		$sql = "SELECT	*
			FROM	".static::getDatabaseTableName()."
			WHERE	categoryName = ?
				AND packageID = ?";
		$statement = WCF::getDB()->prepareStatement($sql);
		$statement->execute(array($categoryName, $packageID));
		$row = $statement->fetchArray();

		if (!$row) {
			$row = array();
		}
		
		return new CharacterOptionCategory(null, $row);
	}
}
