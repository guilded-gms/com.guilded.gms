<?php
namespace gms\data\event\participation;
use wcf\data\DatabaseObjectList;

/**
 * Represents a list of event participation.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	CC BY-NC-SA 3.0 <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	data.event.participation
 * @category	Guilded 2.0
 */
class EventParticipationList extends DatabaseObjectList {
	/**
	 * @see	wcf\data\DatabaseObjectList::$className
	 */
	public $className = 'gms\data\event\participation\EventParticipation';
}
