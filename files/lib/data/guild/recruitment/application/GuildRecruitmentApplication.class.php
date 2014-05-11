<?php
namespace gms\data\guild\recruitment\application;
use gms\data\GMSDatabaseObject;
use gms\data\guild\Guild;
use gms\data\guild\recruitment\tender\GuildRecruitmentTender;
use wcf\system\WCF;

/**
 * Represents a guild application.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons <BY-NC-SA> (http://creativecommons.org/licenses/by-nc-sa/3.0/legalcode)
 * @package	com.guilded.gms
 * @subpackage	data.guild.recruitment.application
 * @category	Guilded 2.0
 */
class GuildRecruitmentApplication extends GMSDatabaseObject {
	/**
	 * @see	\wcf\data\DatabaseObject::$databaseTableName
	 */
	protected static $databaseTableName = 'guild_recruitment_application';
	
	/**
	 * @see	\wcf\data\DatabaseObject::$databaseTableIndexName
	 */
	protected static $databaseTableIndexName = 'applicationID';

	/**
	 * guild object
	 * @var	\gms\data\guild\Guild
	 */
	protected $guild = null;

	/**
	 * tender object
	 * @var	\gms\data\guild\recruitment\tender\GuildRecruitmentTender
	 */
	protected $tender = null;

	/**
	 * Returns tender object.
	 *
	 * @return	\gms\data\guild\recruitment\tender\GuildRecruitmentTender
	 */
	public function getTender() {
		if ($this->tender === null) {
			$this->tender = new GuildRecruitmentTender($this->tenderID);
		}

		return $this->tender;
	}

	/**
	 * Returns guild object.
	 *
	 * @return	\gms\data\guild\Guild
	 */
	public function getGuild() {
		if ($this->guild === null) {
			$this->guild = new Guild($this->guildID);
		}

		return $this->guild;
	}
}
