<?php
namespace wcf\data\guild\recruitment\application;
use wcf\data\DatabaseObject;
use wcf\system\WCF;

class GuildRecruitmentApplication extends DatabaseObject {
	/**
	 * @see	wcf\data\DatabaseObject::$databaseTableName
	 */
	protected static $databaseTableName = 'guild_recruitment_application';
	
	/**
	 * @see	wcf\data\DatabaseObject::$databaseTableIndexName
	 */
	protected static $databaseTableIndexName = 'applicationID';
}
