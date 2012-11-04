<?php
namespace wcf\data\guild;
use wcf\data\DatabaseObject;
use wcf\data\guild\GuildList;
use wcf\system\request\IRouteController;
use wcf\system\WCF;

class GuildAlliance extends DatabaseObject implements IRouteController{
	/**
	 * @see	wcf\data\DatabaseObject::$databaseTableName
	 */
	protected static $databaseTableName = 'guild_alliance';
	
	/**
	 * @see	wcf\data\DatabaseObject::$databaseTableIndexName
	 */
	protected static $databaseTableIndexName = 'allianceID';

	/**
	 * List of guilds.
	 */
	protected $guilds = array();

	/**
	 * @see	wcf\system\request\IRouteController::getID()
	 */
	public function getID() {
		return $this->allianceID;
	}
	
	/**
	 * @see	wcf\system\request\IRouteController::getTitle()
	 */
	public function getTitle() {
		return $this->name;
	}
	
	/**
	 * Returns list of all guild members
	 */
	public function getGuilds() {
		if (!count($this->guilds)) {
			$guildList = new GuildList;
			$guildList->sqlJoins .= "INNER JOIN wcf".WCF_N."_guild_to_alliance guild_to_alliance ON (guild_to_alliance.guildID = guild.guildID)"
			$guildList->getConditionBuilder()->add('guild_to_alliance.allianceID = ?', array($this->allianceID));
			$guildList->readObjects();
			
			$this->guilds = $guildList->getObjects();
		}
		
		return $this->guilds;
	}
}
