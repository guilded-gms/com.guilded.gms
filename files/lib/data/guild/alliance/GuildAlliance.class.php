<?php
namespace wcf\data\guild;
use wcf\data\DatabaseObject;
use wcf\data\character\CharacterList;
use wcf\data\guild\GuildList;
use wcf\system\api\rest\response\IRESTfulResponse;
use wcf\system\request\IRouteController;
use wcf\system\WCF;

class GuildAlliance extends DatabaseObject implements IRouteController, IRestfulResponse {
	/**
	 * @see	wcf\data\DatabaseObject::$databaseTableName
	 */
	protected static $databaseTableName = 'alliance';
	
	/**
	 * @see	wcf\data\DatabaseObject::$databaseTableIndexName
	 */
	protected static $databaseTableIndexName = 'allianceID';

	/**
	 * List of guilds.
	 */
	protected $guilds = array();

	/**
	 * List of characters.
	 */
	protected $characters = array();

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
		if (empty($this->guilds)) {
			$guildList = new GuildList;
			$guildList->sqlJoins .= "INNER JOIN wcf".WCF_N."_alliance_to_guild alliance_to_guild ON (alliance_to_guild.guildID = guild.guildID)"
			$guildList->getConditionBuilder()->add('alliance_to_guild.allianceID = ?', array($this->allianceID));
			$guildList->readObjects();
			
			$this->guilds = $guildList->getObjects();
		}
		
		return $this->guilds;
	}
	
	/**
	 * Returns list of all characters
	 */
	public function getCharacters() {
		if (empty($this->characters)) {
			$guildIDs = array_keys($this->getGuilds());
			
			// \todo add character with guildIDs
			$characterList = new CharacterList;
			$characterList->sqlJoins .= "LEFT JOIN wcf".WCF_N."_alliance_to_character alliance_to_character ON (alliance_to_character.characterID = character_table.characterID)";
			$characterList->getConditionBuilder()->add('alliance_to_character.allianceID = ?', array($this->allianceID));
			$characterList->readObjects();
			
			$this->characters = $characterList->getObjects();			
		}
	
		return $this->characters;
	}

	/**
	 * @see	IRESTfulResponse::getResponseFields()
	 */
	public function getResponseFields() {
		return array_keys(array_merge($this->data, array('guilds', 'characters')));
	}		
}
