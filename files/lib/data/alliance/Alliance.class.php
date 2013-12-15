<?php
namespace gms\data\alliance;
use gms\data\character\CharacterList;
use gms\data\guild\GuildList;
use wcf\data\DatabaseObject;
use wcf\system\request\IRouteController;

/**
 * Represents an alliance of guilds and characters
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2013 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	data.alliance
 * @category	Guilded 2.0
 */
class Alliance extends DatabaseObject implements IRouteController {
	/**
	 * @see	\wcf\data\DatabaseObject::$databaseTableName
	 */
	protected static $databaseTableName = 'alliance';
	
	/**
	 * @see	\wcf\data\DatabaseObject::$databaseTableIndexName
	 */
	protected static $databaseTableIndexName = 'allianceID';

	/**
	 * list of guilds
	 * @var	array<\gms\data\guild\Guild>
	 */
	protected $guilds = array();

	/**
	 * list of characters
	 * @var	array<\gms\data\character\Character>
	 */
	protected $characters = array();
	
	/**
	 * @see	\wcf\system\request\IRouteController::getTitle()
	 */
	public function getTitle() {
		return $this->name;
	}

	/**
	 * Returns a list of all guild members
	 */
	public function getGuilds() {
		if (empty($this->guilds)) {
			$guildList = new GuildList;
			$guildList->sqlJoins .= "INNER JOIN wcf".WCF_N."_alliance_to_guild alliance_to_guild ON (alliance_to_guild.guildID = guild.guildID)";
			$guildList->getConditionBuilder()->add('alliance_to_guild.allianceID = ?', array($this->allianceID));
			$guildList->readObjects();
			
			$this->guilds = $guildList->getObjects();
		}
		
		return $this->guilds;
	}
	
	/**
	 * Returns a list of all characters
	 */
	public function getCharacters() {
		if (empty($this->characters)) {
			$guildIDs = array_keys($this->getGuilds());

			$characterList = new CharacterList;
			$characterList->sqlJoins .= "LEFT JOIN wcf".WCF_N."_alliance_to_character alliance_to_character ON (alliance_to_character.characterID = character_table.characterID)".(!empty($guildIDs) ? " OR (character_table.guildID IN (".implode(',', $guildIDs)."))" : "");
			$characterList->getConditionBuilder()->add('alliance_to_character.allianceID = ?', array($this->allianceID));
			$characterList->readObjects();
			
			$this->characters = $characterList->getObjects();			
		}
	
		return $this->characters;
	}
}
