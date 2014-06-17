<?php
namespace gms\data\alliance;
use gms\data\character\CharacterList;
use gms\data\GMSDatabaseObject;
use gms\data\guild\GuildList;
use wcf\system\request\IRouteController;

/**
 * Represents an alliance of guilds and characters
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	data.alliance
 * @category	Guilded 2.0
 */
class Alliance extends GMSDatabaseObject implements IRouteController {
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
	 * @var	\gms\data\guild\GuildList
	 */
	protected $guildList = null;

	/**
	 * list of characters
	 * @var	\gms\data\character\CharacterList
	 */
	protected $characterList = null;
	
	/**
	 * @see	\wcf\system\request\IRouteController::getTitle()
	 */
	public function getTitle() {
		return $this->name;
	}

	/**
	 * Returns a list of all guild members
	 *
	 * @return	\gms\data\guild\GuildList
	 */
	public function getGuilds() {
		if ($this->guildList === null) {
			$this->guildList = new GuildList();
			$this->guildList->sqlJoins .= "INNER JOIN gms".WCF_N."_alliance_to_guild alliance_to_guild ON (alliance_to_guild.guildID = guild.guildID)";
			$this->guildList->getConditionBuilder()->add('alliance_to_guild.allianceID = ?', array($this->allianceID));
			$this->guildList->readObjects();
		}
		
		return $this->guildList;
	}
	
	/**
	 * Returns a list of all characters
	 *
	 * @return	\gms\data\character\CharacterList
	 */
	public function getCharacters() {
		if ($this->characterList === null) {
			$guildIDs = $this->getGuilds()->getObjectIDs();

			$this->characterList = new CharacterList();
			$this->characterList->sqlJoins .= "LEFT JOIN gms".WCF_N."_alliance_to_character alliance_to_character ON (alliance_to_character.characterID = character_table.characterID)" . (!empty($guildIDs) ? " OR (character_table.guildID IN (".implode(',', $guildIDs)."))" : "");
			$this->characterList->getConditionBuilder()->add('alliance_to_character.allianceID = ?', array($this->allianceID));
			$this->characterList->readObjects();
		}
	
		return $this->characterList;
	}
}
