<?php
namespace gms\data\calendar\menu\item;
use gms\data\GMSDatabaseObject;
use wcf\system\exception\SystemException;
use wcf\util\ClassUtil;

/**
 * Represents a calendar menu item (view).
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	CC BY-NC-SA 3.0 <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	data.calendar.menu.item
 * @category	Guilded 2.0
 */
class CalendarMenuItem extends GMSDatabaseObject {
	/**
	 * @see	\wcf\data\DatabaseObject::$databaseTableName
	 */
	protected static $databaseTableName = 'calendar_menu_item';
	
	/**
	 * @see	\wcf\data\DatabaseObject::$databaseTableIndexName
	 */
	protected static $databaseTableIndexName = 'menuItemID';

	/**
	 * content manager
	 * @var	\gms\system\menu\calendar\content\ICalendarMenuContent
	 */
	protected $contentManager = null;

	/**
	 * Returns the item identifier, dots are replaced by underscores.
	 *
	 * @return	string
	 */
	public function getIdentifier() {
		return str_replace('.', '_', $this->menuItem);
	}

	/**
	 * Returns the content manager for this menu item.
	 *
	 * @throws	\wcf\system\exception\SystemException
	 * @return	\gms\system\menu\calendar\content\ICalendarMenuContent
	 */
	public function getContentManager() {
		if ($this->contentManager === null) {
			if (!class_exists($this->className)) {
				throw new SystemException("Unable to find class '".$this->className."'");
			}

			if (!ClassUtil::isInstanceOf($this->className, 'wcf\system\SingletonFactory')) {
				throw new SystemException("'".$this->className."' does not extend 'wcf\system\SingletonFactory'");
			}

			if (!ClassUtil::isInstanceOf($this->className, 'gms\system\menu\calendar\content\ICalendarMenuContent')) {
				throw new SystemException("'".$this->className."' does not implement 'gms\system\menu\calendar\content\ICalendarMenuContent'");
			}

			$this->contentManager = call_user_func(array($this->className, 'getInstance'));
		}

		return $this->contentManager;
	}
}
