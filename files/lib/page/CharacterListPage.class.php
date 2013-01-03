<?php
namespace wcf\page;
use wcf\system\menu\page\PageMenu;

/**
 * Shows a list of characters
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2013 DevLabor UG (haftungsbeschränkt)
 * @license	CC BY-NC-SA 3.0 <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.wcf.character
 * @subpackage	page
 * @category	Guilded 2.0
*/
class CharacterListPage extends SortablePage {
	/**
	 * @see wcf\page\AbstractPage::$neededPermissions
	 */
	public $neededPermissions = array();
	
	/**
	 * @see wcf\page\SortablePage::$defaultSortField
	 */
	public $defaultSortField = 'name';
	
	/**
	 * @see wcf\page\SortablePage::$validSortFields
	 */
	public $validSortFields = array('name');
	
	/**
	 * @see	wcf\page\MultipleLinkPage::$objectListClassName
	 */	
	public $objectListClassName = 'wcf\data\character\CharacterList';
	
	/**
	 * @see	wcf\page\IPage::show()
	 */
	public function show() {
		PageMenu::getInstance()->setActiveMenuItem('wcf.character.characters');
		
		parent::show();
	}
}
