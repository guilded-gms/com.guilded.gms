<?php
namespace gms\data\guild\activity;
use gms\data\GMSDatabaseObject;
use wcf\system\WCF;

class GuildActivity extends GMSDatabaseObject {
	/**
	 * @see	\wcf\data\DatabaseObject::$databaseTableName
	 */
	protected static $databaseTableName = 'guild_activity';
	
	/**
	 * @see	\wcf\data\DatabaseObject::$databaseTableIndexName
	 */
	protected static $databaseTableIndexName = 'activityID';
}
