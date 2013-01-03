<?php
namespace wcf\data\alliance;
use wcf\data\DatabaseObject;
use wcf\data\character\CharacterList;
use wcf\data\guild\GuildList;
use wcf\system\api\rest\response\IRESTfulResponse;
use wcf\system\request\IRouteController;
use wcf\system\WCF;

/**
 * Represents an alliance of guilds and characters
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2013 DevLabor UG (haftungsbeschränkt)
 * @license	CC BY-NC-SA 3.0 <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.wcf.character
 * @subpackage	data.alliance
 * @category	Guilded 2.0
*/
class Alliance extends DatabaseObject implements IRestfulResponse, IRouteController {
	/**
	 * @see	wcf\data\DatabaseObject::$databaseTableName
	 */
	protected static $databaseTableName = 'alliance';
	
	/**
	 * @see	wcf\data\DatabaseObject::$databaseTableIndexName
	 */
	protected static $databaseTableIndexName = 'allianceID';

	/**
	 * List of guilds
	 * @type	array<wcf\data\guild\Guild>
	 */
	protected $guilds = array();

	/**
	 * List of characters
	 * @type	array<wcf\data\character\Character>	 
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
	 * @see	wcf\data\DatabaseObject::handleData()
	 */
	protected function handleData($data) {
		parent::handleData($data);
		
		// add to data, so we can access them by api
		$this->data['guilds'] = $this->getGuilds();
		$this->data['characters'] = $this->getCharacters();
	}
	
	/**
	 * Returns a list of all guild members
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

	/**
	 * @see	wcf\system\api\rest\response\IRESTfulResponse::getResponseFields()
	 */
	public function getResponseFields() {
		return array_keys($this->data);
	}		
}
