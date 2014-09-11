<?php
namespace gms\system\menu\guild\profile;
use gms\data\guild\Guild;
use gms\data\guild\profile\menu\item\GuildProfileMenuItem;
use gms\system\cache\builder\GuildProfileMenuCacheBuilder;
use wcf\system\event\EventHandler;
use wcf\system\SingletonFactory;

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
class GuildProfileMenu extends SingletonFactory {
	/**
	 * list of all menu items
	 * @var	array<\gms\data\guild\profile\menu\item\GuildProfileMenuItem>
	 */
	public $menuItems = null;

	/**
	 * active menu item
	 * @var	\gms\data\guild\profile\menu\item\GuildProfileMenuItem
	 */
	public $activeMenuItem = null;

	/**
	 * @see	\wcf\system\SingletonFactory::init()
	 */
	protected function init() {
		// get menu items from cache
		$this->loadCache();

		// check menu items
		$this->checkMenuItems();

		// call init event
		EventHandler::getInstance()->fireAction($this, 'init');
	}

	/**
	 * Checks the options and permissions of the menu items.
	 */
	protected function checkMenuItems() {
		foreach ($this->menuItems as $key => $item) {
			if (!$this->checkMenuItem($item)) {
				// remove this item
				unset($this->menuItems[$key]);
			}
		}
	}

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

	/**
	 * Checks the options and permissions of given menu item.
	 *
	 * @param	\gms\data\guild\profile\menu\item\GuildProfileMenuItem	$item
	 * @return	boolean
	 */
	protected function checkMenuItem(GuildProfileMenuItem $item) {
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

	/**
	 * Returns the list of menu items.
	 *
	 * @return	array<\gms\data\guild\profile\menu\item\GuildProfileMenuItem>
	 */
	public function getMenuItems() {
		return $this->menuItems;
	}

	/**
	 * Sets active menu item.
	 *
	 * @param	string		$menuItem
	 * @return	boolean
	 */
	public function setActiveMenuItem($menuItem) {
		foreach ($this->menuItems as $item) {
			if ($item->menuItem == $menuItem) {
				$this->activeMenuItem = $item;
				return true;
			}
		}

		return false;
	}

	/**
	 * Returns the first menu item.
	 *
	 * @return	\gms\data\guild\profile\menu\item\GuildProfileMenuItem
	 */
	public function getActiveMenuItem() {
		if (empty($this->menuItems)) {
			return null;
		}

		if ($this->activeMenuItem === null) {
			reset($this->menuItems);
			$this->activeMenuItem = current($this->menuItems);
		}

		return $this->activeMenuItem;
	}

	/**
	 * Returns a specific menu item.
	 *
	 * @return	\gms\data\guild\profile\menu\item\GuildProfileMenuItem
	 */
	public function getMenuItem($menuItem) {
		foreach ($this->menuItems as $item) {
			if ($item->menuItem == $menuItem) {
				return $item;
			}
		}

		return null;
	}
}
