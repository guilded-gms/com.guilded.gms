<?php
namespace gms\data\guild;
use gms\data\character\CharacterList;
use gms\data\game\Game;
use gms\data\game\server\GameServer;
use gms\data\guild\recruitment\application\GuildRecruitmentApplicationList;
use gms\data\guild\recruitment\tender\GuildRecruitmentTenderList;
use gms\data\GMSDatabaseObject;
use wcf\system\request\IRouteController;

/**
 * Represents a guild.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons <BY-NC-SA> (http://creativecommons.org/licenses/by-nc-sa/3.0/legalcode)
 * @package	com.guilded.gms
 * @subpackage	data.guild
 * @category	Guilded 2.0
 */
class Guild extends GMSDatabaseObject implements IRouteController {
	/**
	 * @see	\wcf\data\DatabaseObject::$databaseTableName
	 */
	protected static $databaseTableName = 'guild';
	
	/**
	 * @see	\wcf\data\DatabaseObject::$databaseTableIndexName
	 */
	protected static $databaseTableIndexName = 'guildID';

	/**
	 * List of guild members.
	 * @var	\gms\data\character\CharacterList
	 */
	protected $characterList = array();
	
	/**
	 * List of guild tenders.
	 * @var	\gms\data\guild\recruitment\tender\GuildRecruitmentTenderList
	 */
	protected $tenderList = array();

	/**
	 * list of applications
	 * @var	\gms\data\guild\recruitment\application\GuildRecruitmentApplicationList
	 */
	protected $applicationList = array();

	/**
	 * game object
	 * @var	\gms\data\game\Game
	 */
	protected $game = null;

	/**
	 * server object
	 * @var	\gms\data\game\server\GameServer
	 */
	protected $server = null;

	/**
	 * @see	\wcf\system\request\IRouteController::getTitle()
	 */
	public function getTitle() {
		return $this->name;
	}

	/**
	 * Returns a list of guilds, categorized by game.
	 *
	 * @return	array
	 */
	public static function getCategorizedGuilds() {
		$options = array();

		$guildList = new GuildList();
		$guildList->readObjects();

		foreach ($guildList->getObjects() as $guild) {
			$options[$guild->getGame()->getTitle()][] = $guild;
		}

		return $options;
	}

	/**
	 * Returns list of all guild members
	 *
	 * @return	\gms\data\character\CharacterList
	 */
	public function getCharacters() {
		if (empty($this->characterList)) {
			$this->characterList = new CharacterList;
			$this->characterList->getConditionBuilder()->add('guildID = ?', array($this->guildID));
			$this->characterList->readObjects();
		}

		return $this->characterList;
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
	 * Returns server object.
	 *
	 * @return	\gms\data\game\server\GameServer
	 */
	public function getServer() {
		if ($this->server === null) {
			$this->server = GameServer::getServerByName($this->gameID, $this->server);
		}

		return $this->server;
	}

	/**
	 * Checks whether given character is a member of this guild.
	 *
	 * @param integer $characterID
	 * @return boolean
	 */
	public function isMember($characterID) {
		$characterIDs = $this->getCharacters()->getObjectIDs();
		return in_array($characterID, $characterIDs);
	}
	
	/**
	 * Returns list of all tenders.
	 *
	 * @return	\gms\data\guild\recruitment\tender\GuildRecruitmentTenderList
	 */
	public function getTenders() {
		if (empty($this->tenderList)) {
			$this->tenderList = new GuildRecruitmentTenderList();
			$this->tenderList->getConditionBuilder()->add('guildID = ?', array($this->guildID));
			$this->tenderList->readObjects();
		}
		
		return $this->tenderList;
	}

	/**
	 * Returns a list of all guild recruitment applications.
	 *
	 * @return	\gms\data\guild\recruitment\application\GuildRecruitmentApplicationList
	 */
	public function getApplications() {
		if (empty($this->applicationList)) {
			$this->applicationList = new GuildRecruitmentApplicationList();
			$this->applicationList->getConditionBuilder()->add('guildID = ?', array($this->guildID));
			$this->applicationList->readObjects();
		}

		return $this->applicationList;
	}

	/**
	 * Returns true if guild profile is viewable.
	 *
	 * @return	bool
	 */
	public function canView() {
		return true;
	}
}
