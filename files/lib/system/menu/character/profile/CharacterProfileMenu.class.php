<?php
namespace gms\system\menu\character\profile;
use gms\data\character\Character;
use gms\data\character\profile\menu\item\CharacterProfileMenuItem;
use gms\system\cache\builder\CharacterProfileMenuCacheBuilder;
use wcf\system\event\EventHandler;
use wcf\system\SingletonFactory;

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
class CharacterProfileMenu extends SingletonFactory {
	/**
	 * list of all menu items
	 * @var	array<\wcf\data\user\profile\menu\item\UserProfileMenuItem>
	 */
	public $menuItems = null;

	/**
	 * active menu item
	 * @var	\wcf\data\user\profile\menu\item\UserProfileMenuItem
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

		$this->menuItems = CharacterProfileMenuCacheBuilder::getInstance()->getData();
	}

	/**
	 * Returns a list of accessible menuItem by given character.
	 *
	 * @param	\gms\data\character\Character	$character
	 * @return	array
	 */
	public function getAccessibleMenuItems(Character $character) {
		$menuItems = $this->getMenuItems();

		foreach ($menuItems as $key => $menuItem) {
			if (!$menuItem->getContentManager()->isAccessible($character)) {
				unset($menuItems[$key]);
			}
		}

		return $menuItems;
	}

	/**
	 * Checks the options and permissions of given menu item.
	 *
	 * @param	\gms\data\character\profile\menu\item\CharacterProfileMenuItem	$item
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

	/**
	 * Returns the list of menu items.
	 *
	 * @return	array<\wcf\data\user\profile\menu\item\UserProfileMenuItem>
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
	 * @return	\wcf\data\user\profile\menu\item\UserProfileMenuItem
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
	 * @return	\wcf\data\user\profile\menu\item\UserProfileMenuItem
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
