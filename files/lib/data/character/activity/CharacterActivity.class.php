<?php
namespace gms\data\character\activity;
use wcf\data\DatabaseObject;
use wcf\system\WCF;

class CharacterActivity extends DatabaseObject {
	/**
	 * @see	\wcf\data\DatabaseObject::$databaseTableName
	 */
	protected static $databaseTableName = 'character_activity';
	
	/**
	 * @see	\wcf\data\DatabaseObject::$databaseTableIndexName
	 */
	protected static $databaseTableIndexName = 'activityID';
}
