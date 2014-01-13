<?php
namespace gms\system\menu\character\profile;
use gms\data\character\Character;
use gms\system\cache\builder\CharacterProfileMenuCacheBuilder;
use wcf\system\event\EventHandler;
use wcf\system\menu\user\profile\UserProfileMenu;

/**
 * Builds the character profile menu.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons <BY-NC-SA> (http://creativecommons.org/licenses/by-nc-sa/3.0/legalcode)
 * @package	com.guilded.gms
 * @subpackage	system.menu.character.profile
 * @category	Guilded 2.0
 */
class CharacterProfileMenu extends UserProfileMenu {
	/**
	 * @see	\wcf\system\menu\user\profile\UserProfileMenu::loadCache()
	 */
	protected function loadCache() {
		// call loadCache event
		EventHandler::getInstance()->fireAction($this, 'loadCache');

		$this->menuItems = CharacterProfileMenuCacheBuilder::getInstance()->getData();
	}

	public function getAccessibleMenuItems(Character $character) {
		$menuItems = $this->getMenuItems();

		foreach ($menuItems as $key => $menuItem) {
			if (!$menuItem->getContentManager()->isAccessible($character)) {
				unset($menuItems[$key]);
			}
		}

		return $menuItems;
	}
}
