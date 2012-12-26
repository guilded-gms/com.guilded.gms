<?php
namespace wcf\system\cache\builder;
use wcf\data\character\profile\menu\item\CharacterProfileMenuItem;
use wcf\system\WCF;

class CharacterProfileMenuCacheBuilder implements ICacheBuilder {
	/**
	 * @see	wcf\system\cache\ICacheBuilder::getData()
	 */
	public function getData(array $cacheResource) { 
		$data = array();
		
		$sql = "SELECT		menuItemID, menuItem, permissions, options, packageDir, menu_item.packageID, className
			FROM		wcf".WCF_N."_character_profile_menu_item menu_item
			LEFT JOIN	wcf".WCF_N."_package package
			ON		(package.packageID = menu_item.packageID)
			ORDER BY	showOrder ASC";
		$statement = WCF::getDB()->prepareStatement($sql);
		$statement->execute();
		while ($row = $statement->fetchArray()) {
			$data[] = new CharacterProfileMenuItem(null, $row);
		}
				
		return $data;
	}
}
