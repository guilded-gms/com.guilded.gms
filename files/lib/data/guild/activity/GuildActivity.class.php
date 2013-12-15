<?php
namespace gms\data\guild\activity;
use wcf\data\DatabaseObject;
use wcf\system\WCF;

class GuildActivity extends DatabaseObject {
	/**
	 * @see	\wcf\data\DatabaseObject::$databaseTableName
	 */
	protected static $databaseTableName = 'guild_activity';
	
	/**
	 * @see	\wcf\data\DatabaseObject::$databaseTableIndexName
	 */
	protected static $databaseTableIndexName = 'activityID';
}
