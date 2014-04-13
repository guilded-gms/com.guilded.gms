<?php
namespace gms\system\cache\builder;
use gms\data\calendar\menu\item\CalendarMenuItemList;
use wcf\system\cache\builder\AbstractCacheBuilder;

/**
 * Caches the guild profile menu items.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons <BY-NC-SA> (http://creativecommons.org/licenses/by-nc-sa/3.0/legalcode)
 * @package	com.guilded.gms
 * @subpackage	system.cache.builder
 * @category	Guilded 2.0
 */
class CalendarMenuCacheBuilder extends AbstractCacheBuilder {
	/**
	 * @see	\wcf\system\cache\builder\AbstractCacheBuilder::rebuild()
	 */
	protected function rebuild(array $parameters) {
		$itemList = new CalendarMenuItemList();
		$itemList->sqlOrderBy = "calendar_menu_item.showOrder ASC";
		$itemList->readObjects();

		return $itemList->getObjects();
	}
}
