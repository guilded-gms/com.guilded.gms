<?php
namespace wcf\data\guild\option\category;
use wcf\data\DatabaseObject;
use wcf\system\WCF;

class GuildOptionCategory extends DatabaseObject {
	/**
	 * @see	wcf\data\DatabaseObject::$databaseTableName
	 */
	protected static $databaseTableName = 'guild_option_category';
	
	/**
	 * @see	wcf\data\DatabaseObject::$databaseTableIndexName
	 */
	protected static $databaseTableIndexName = 'categoryID';
	
	/**
	 * @see	wcf\data\DatabaseObject::__construct()
	 */
	public function __construct($categoryID, $row = null, GuildOptionCategory $category = null) {
		if ($categoryID !== null) {
			$sql = "SELECT	option_category.*,
					(SELECT COUNT(DISTINCT optionName) FROM wcf".WCF_N."_guild_option WHERE categoryName = option_category.categoryName) AS options
				FROM	wcf".WCF_N."_guild_option_category option_category
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
	 * Returns an instance of GuildOptionCategory by name and package id.
	 * 
	 * @param	string		$categoryName
	 * @param	integer		$packageID
	 * @return	wcf\data\guild\option\category\GuildOptionCategory
	 */
	public static function getCategoryByName($categoryName, $packageID) {
		$sql = "SELECT	*
			FROM	wcf".WCF_N."_guild_option_category
			WHERE	categoryName = ?
				AND packageID = ?";
		$statement = WCF::getDB()->prepareStatement($sql);
		$statement->execute(array($categoryName, $packageID));
		$row = $statement->fetchArray();
		if (!$row) $row = array();
		
		return new GuildOptionCategory(null, $row);
	}
}
