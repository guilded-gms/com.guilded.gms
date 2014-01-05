<?php
namespace gms\data\event;
use wcf\data\DatabaseObjectList;

class EventList extends DatabaseObjectList {
	/**
	 * @see	wcf\data\DatabaseObjectList::$className
	 */
	public $className = 'gms\data\event\Event';
}
