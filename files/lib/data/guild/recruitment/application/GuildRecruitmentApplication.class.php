<?php
namespace gms\data\guild\recruitment\application;
use wcf\data\DatabaseObject;
use wcf\system\WCF;

/**
 * Represents a guild application.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2013 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons <BY-NC-SA> (http://creativecommons.org/licenses/by-nc-sa/3.0/legalcode)
 * @package	com.guilded.gms
 * @subpackage	data.guild.recruitment.application
 * @category	Guilded 2.0
 */
class GuildRecruitmentApplication extends DatabaseObject {
	/**
	 * @see	\wcf\data\DatabaseObject::$databaseTableName
	 */
	protected static $databaseTableName = 'guild_recruitment_application';
	
	/**
	 * @see	\wcf\data\DatabaseObject::$databaseTableIndexName
	 */
	protected static $databaseTableIndexName = 'applicationID';
}
