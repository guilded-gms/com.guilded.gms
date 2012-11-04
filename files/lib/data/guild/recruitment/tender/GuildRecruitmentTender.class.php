<?php
namespace wcf\data\guild\recruitment\tender;
use wcf\data\DatabaseObject;
use wcf\system\WCF;

class GuildRecruitmentTender extends DatabaseObject {
	/**
	 * @see	wcf\data\DatabaseObject::$databaseTableName
	 */
	protected static $databaseTableName = 'guild_recruitment_tender';
	
	/**
	 * @see	wcf\data\DatabaseObject::$databaseTableIndexName
	 */
	protected static $databaseTableIndexName = 'tenderID';
}
