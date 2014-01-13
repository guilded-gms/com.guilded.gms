<?php
namespace gms\data\event\participation;
use gms\data\GMSDatabaseObject;

class EventParticipation extends GMSDatabaseObject {
	/**
	 * @see	wcf\data\DatabaseObject::$databaseTableName
	 */
	protected static $databaseTableName = 'event_participation';
	
	/**
	 * @see	wcf\data\DatabaseObject::$databaseTableIndexName
	 */
	protected static $databaseTableIndexName = 'participationID';
}
