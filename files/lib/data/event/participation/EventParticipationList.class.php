<?php
namespace gms\data\event\participation;
use wcf\data\DatabaseObjectList;

class EventParticipationList extends DatabaseObjectList {
	/**
	 * @see	wcf\data\DatabaseObjectList::$className
	 */
	public $className = 'gms\data\event\participation\EventParticipation';
}
