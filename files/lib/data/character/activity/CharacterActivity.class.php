<?php
namespace gms\data\character\activity;
use gms\data\GMSDatabaseObject;
use wcf\system\WCF;

class CharacterActivity extends GMSDatabaseObject {
	/**
	 * @see	\wcf\data\DatabaseObject::$databaseTableName
	 */
	protected static $databaseTableName = 'character_activity';
	
	/**
	 * @see	\wcf\data\DatabaseObject::$databaseTableIndexName
	 */
	protected static $databaseTableIndexName = 'activityID';
}
