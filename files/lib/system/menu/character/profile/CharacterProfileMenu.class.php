<?php
namespace wcf\system\menu\character\profile;
use wcf\system\menu\user\profile\UserProfileMenu;
use wcf\data\character\profile\menu\item\CharacterProfileMenuItem;

class CharacterProfileMenu extends UserProfileMenu {
	/**
	 * @see wcf\system\menu\user\profile\UserProfileMenu::loadCache()
	 */
	protected function loadCache() {
		// call loadCache event
		EventHandler::getInstance()->fireAction($this, 'loadCache');
		
		CacheHandler::getInstance()->addResource(
			'characterProfileMenu',
			WCF_DIR.'cache/cache.characterProfileMenu.php',
			'wcf\system\cache\builder\CharacterProfileMenuCacheBuilder'
		);
		$this->menuItems = CacheHandler::getInstance()->get('characterProfileMenu');
	}
	
	/**
	 * Checks the options and permissions of given menu item.
	 * 
	 * @param	wcf\data\user\profile\menu\item\CharacterProfileMenuItem	$item
	 * @return	boolean
	 */
	protected function checkMenuItem(CharacterProfileMenuItem $item) {
		// check the options of this item
		$hasEnabledOption = true;
		if (!empty($item->options)) {
			$hasEnabledOption = false;
			$options = explode(',', strtoupper($item->options));
			foreach ($options as $option) {
				if (defined($option) && constant($option)) {
					$hasEnabledOption = true;
					break;
				}
			}
		}
		if (!$hasEnabledOption) return false;
		
		// check the permission of this item for the active user
		$hasPermission = true;
		if (!empty($item->permissions)) {
			$hasPermission = false;
			$permissions = explode(',', $item->permissions);
			foreach ($permissions as $permission) {
				if (WCF::getSession()->getPermission($permission)) {
					$hasPermission = true;
					break;
				}
			}
		}
		if (!$hasPermission) return false;
		
		return true;
	}
}
