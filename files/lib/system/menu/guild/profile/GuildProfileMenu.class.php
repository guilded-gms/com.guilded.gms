<?php
namespace gms\system\menu\guild\profile;
use gms\data\guild\Guild;
use gms\system\cache\builder\GuildProfileMenuCacheBuilder;
use wcf\system\event\EventHandler;
use wcf\system\menu\user\profile\UserProfileMenu;

/**
 * Builds the guild profile menu.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons <BY-NC-SA> (http://creativecommons.org/licenses/by-nc-sa/3.0/legalcode)
 * @package	com.guilded.gms
 * @subpackage	system.guild.profile
 * @category	Guilded 2.0
 */
class GuildProfileMenu extends UserProfileMenu {
	/**
	 * @see	\wcf\system\menu\user\profile\UserProfileMenu::loadCache()
	 */
	protected function loadCache() {
		// call loadCache event
		EventHandler::getInstance()->fireAction($this, 'loadCache');

		$this->menuItems = GuildProfileMenuCacheBuilder::getInstance()->getData();
	}

	/**
	 * Returns a list of accessible menuItem by given guild.
	 *
	 * @param	\gms\data\guild\Guild	$guild
	 * @return	array
	 */
	public function getAccessibleMenuItems(Guild $guild) {
		$menuItems = $this->getMenuItems();

		foreach ($menuItems as $key => $menuItem) {
			if (!$menuItem->getContentManager()->isAccessible($guild)) {
				unset($menuItems[$key]);
			}
		}

		return $menuItems;
	}
}
