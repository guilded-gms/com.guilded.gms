<?php
namespace gms\data\guild\option\category;
use gms\data\GMSDatabaseObject;
use wcf\system\WCF;

class GuildOptionCategory extends GMSDatabaseObject {
	/**
	 * @see	\wcf\data\DatabaseObject::$databaseTableName
	 */
	protected static $databaseTableName = 'guild_option_category';
	
	/**
	 * @see	\wcf\data\DatabaseObject::$databaseTableIndexName
	 */
	protected static $databaseTableIndexName = 'categoryID';
	
	/**
	 * @see	\wcf\data\DatabaseObject::__construct()
	 */
	public function __construct($categoryID, $row = null, GuildOptionCategory $category = null) {
		if ($categoryID !== null) {
			$sql = "SELECT	guild_option_category.*,
							(SELECT COUNT(DISTINCT guild_option.optionName) FROM gms".WCF_N."_guild_option guild_option WHERE guild_option.categoryName = guild_option_category.categoryName) AS options
					FROM	gms".WCF_N."_guild_option_category guild_option_category
					WHERE	guild_option_category.categoryID = ?";
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
	 * @return	\gms\data\guild\option\category\GuildOptionCategory
	 */
	public static function getCategoryByName($categoryName, $packageID) {
		$sql = "SELECT	*
			FROM	gms".WCF_N."_guild_option_category
			WHERE	categoryName = ?
				AND packageID = ?";
		$statement = WCF::getDB()->prepareStatement($sql);
		$statement->execute(array($categoryName, $packageID));
		$row = $statement->fetchArray();

		if (!$row) {
			$row = array();
		}
		
		return new GuildOptionCategory(null, $row);
	}
}
