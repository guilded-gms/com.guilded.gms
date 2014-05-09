<?php
namespace gms\data\event;
use wcf\data\AbstractDatabaseObjectAction;

/**
 * Event-related actions.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	data.event
 * @category	Guilded 2.0
 */
class EventAction extends AbstractDatabaseObjectAction {
	/**
	 * @see wcf\data\AbstractDatabaseObjectAction::$className
	 */
	protected $className = 'gms\data\event\EventEditor';
}
