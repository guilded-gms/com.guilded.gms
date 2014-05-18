<?php
namespace gms\data\guild\recruitment\tender;
use gms\data\game\classification\GameClassification;
use gms\data\game\Game;
use gms\data\GMSDatabaseObject;
use wcf\system\WCF;

/**
 * Represents a guild tender.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons <BY-NC-SA> (http://creativecommons.org/licenses/by-nc-sa/3.0/legalcode)
 * @package	com.guilded.gms
 * @subpackage	data.guild
 * @category	Guilded 2.0
 */
class GuildRecruitmentTender extends GMSDatabaseObject {
	const PRIORITY_LOW = 1;
	const PRIORITY_MEDIUM = 2;
	const PRIORITY_HIGH = 3;

	/**
	 * @see	\wcf\data\DatabaseObject::$databaseTableName
	 */
	protected static $databaseTableName = 'guild_recruitment_tender';
	
	/**
	 * @see	\wcf\data\DatabaseObject::$databaseTableIndexName
	 */
	protected static $databaseTableIndexName = 'tenderID';

	/**
	 * game object
	 * @var	\gms\data\game\Game
	 */
	protected $game = null;
	
	/**
	 * classification object
	 * @var	\gms\data\game\classification\GameClassification
	 */
	protected $classification = null;
	
	/**
	 * Returns classification object.
	 *
	 * @return	\gms\data\game\classification\GameClassification
	 */
	public function getClassification() {
		if ($this->classification === null) {
			$this->classification = new GameClassification($this->classificationID);
		}
		
		return $this->classification;
	}
	
	/**
	 * Returns game object.
	 *
	 * @return	\gms\data\game\Game
	 */
	public function getGame() {
		if ($this->game === null) {
			$this->game = new Game($this->gameID);
		}
		
		return $this->game;
	}

	/**
	 * Returns badge of priority.
	 *
	 * @return	string
	 */
	public function getBadge() {
		$colorClass = 'green';
		if ($this->priority === self::PRIORITY_MEDIUM) $colorClass = 'orange';
		else if ($this->priority === self::PRIORITY_HIGH) $colorClass = 'red';

		return '<span class="badge ' . $colorClass . '">' . WCF::getLanguage()->get('gms.guild.recruitment.tender.priority.' . $this->priority) . '</span></label>';
	}
}
