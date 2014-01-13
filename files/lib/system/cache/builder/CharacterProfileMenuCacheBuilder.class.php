<?php
namespace gms\system\cache\builder;
use gms\data\character\profile\menu\item\CharacterProfileMenuItemList;
use wcf\system\cache\builder\AbstractCacheBuilder;

/**
 * Caches the character profile menu items.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons <BY-NC-SA> (http://creativecommons.org/licenses/by-nc-sa/3.0/legalcode)
 * @package	com.guilded.gms
 * @subpackage	system.cache.builder
 * @category	Guilded 2.0
 */
class CharacterProfileMenuCacheBuilder extends AbstractCacheBuilder {
	/**
	 * @see	\wcf\system\cache\builder\AbstractCacheBuilder::rebuild()
	 */
	protected function rebuild(array $parameters) {
		$itemList = new CharacterProfileMenuItemList();
		$itemList->sqlOrderBy = "character_profile_menu_item.showOrder ASC";
		$itemList->readObjects();

		return $itemList->getObjects();
	}
}
