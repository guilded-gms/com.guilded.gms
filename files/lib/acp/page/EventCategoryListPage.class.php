<?php
namespace gms\acp\page;

/**
 * Event Categories.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2013 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	acp.page
 * @category	Guilded 2.0
 */
class EventCategoryListPage extends AbstractCategoryListPage {
	/**
	 * @see	AbstractCategoryListPage::$activeMenuItem
	 */
	public $activeMenuItem = 'wcf.acp.menu.link.community.event.category.list';

	/**
	 * @see	AbstractCategoryListPage::$objectTypeName
	 */	
	public $objectTypeName = 'com.guilded.gms.category';
}
