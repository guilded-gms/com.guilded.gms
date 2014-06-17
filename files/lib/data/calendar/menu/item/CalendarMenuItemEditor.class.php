<?php
namespace gms\data\calendar\menu\item;
use wcf\data\DatabaseObjectEditor;

/**
 * Editor for calendar menu item (view).
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	CC BY-NC-SA 3.0 <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	data.calendar.menu.item
 * @category	Guilded 2.0
 */
class CalendarMenuItemEditor extends DatabaseObjectEditor {
	/**
	 * @see	\wcf\data\DatabaseObjectDecorator::$baseClass
	 */
	protected static $baseClass = 'gms\data\calendar\menu\item\CalendarMenuItem';
}
