<?php
namespace wcf\data\character\option\category;
use wcf\data\DatabaseObject;
use wcf\system\WCF;

class CharacterOptionCategory extends DatabaseObject {
	/**
	 * @see	wcf\data\DatabaseObject::$databaseTableName
	 */
	protected static $databaseTableName = 'character_option_category';
	
	/**
	 * @see	wcf\data\DatabaseObject::$databaseTableIndexName
	 */
	protected static $databaseTableIndexName = 'categoryID';
	
	/**
	 * @see	wcf\data\DatabaseObject::__construct()
	 */
	public function __construct($categoryID, $row = null, CharacterOptionCategory $category = null) {
		if ($categoryID !== null) {
			$sql = "SELECT	option_category.*,
					(SELECT COUNT(DISTINCT optionName) FROM wcf".WCF_N."_character_option WHERE categoryName = option_category.categoryName) AS options
				FROM	wcf".WCF_N."_character_option_category option_category
				WHERE	option_category.categoryID = ?";
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
	 * @return	wcf\data\character\option\category\CharacterOptionCategory
	 */
	public static function getCategoryByName($categoryName, $packageID) {
		$sql = "SELECT	*
			FROM	wcf".WCF_N."_character_option_category
			WHERE	categoryName = ?
				AND packageID = ?";
		$statement = WCF::getDB()->prepareStatement($sql);
		$statement->execute(array($categoryName, $packageID));
		$row = $statement->fetchArray();
		if (!$row) $row = array();
		
		return new CharacterOptionCategory(null, $row);
	}
}
