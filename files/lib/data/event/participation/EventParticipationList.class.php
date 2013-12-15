<?php
namespace gms\data\event\participation;
use wcf\data\DatabaseObjectList;

class EventParticipationList extends GMSDatabaseObjectList {
	/**
	 * @see	wcf\data\DatabaseObjectList::$className
	 */
	public $className = 'wcf\data\event\participation\EventParticipation';
}
