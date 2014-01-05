<?php
namespace gms\data\character;
use gms\data\character\rank\CharacterRank;
use gms\data\game\classification\GameClassification;
use gms\data\game\Game;
use gms\data\guild\Guild;
use wcf\data\user\User;
use wcf\data\user\UserProfile;
use gms\data\GMSDatabaseObject;
use wcf\system\request\IRouteController;
use wcf\system\WCF;

/**
 * Represents a character.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	data.character
 * @category	Guilded 2.0
 */
class Character extends GMSDatabaseObject implements IRouteController {
	/**
	 * @see	\wcf\data\DatabaseObject::$databaseTableName
	 */
	protected static $databaseTableName = 'character';
	
	/**
	 * @see	\wcf\data\DatabaseObject::$databaseTableIndexName
	 */
	protected static $databaseTableIndexName = 'characterID';
	
	/**
	 * game object
	 * @var	\gms\data\game\Game
	 */
	protected $game = null;	
	
	/**
	 * UserProfile object
	 * @var	\wcf\data\user\UserProfile
	 */
	protected $user = null;

	/**
	 * Guild object
	 * @var	\gms\data\guild\Guild
	 */
	protected $guild = null;

	/**
	 * character rank in guild
	 * @var \gms\data\character\rank\CharacterRank
	 */
	protected $rank = null;

	/**
	 * @see	\wcf\data\IStorableObject::getDatabaseTableAlias()
	 */
	public static function getDatabaseTableAlias() {
		return static::$databaseTableName.'_table';
	}

	/**
	 * @see	\wcf\system\request\IRouteController::getTitle()
	 */
	public function getTitle() {
		return $this->name;
	}

	/**
	 * Returns character name with rank title. e.g. Marshall Kivah (Marshall %s)
	 *
	 * @return	string
	 */
	public function getTitledName() {
		return sprintf($this->rankTitle, $this->name);
	}
	
	/**
	 * Returns Character-object by characterName.
	 *
	 * @param	string		$characterName
	 * @return	\gms\data\character\Character
	 */
	public static function getCharacterByName($characterName) {
		$sql = "SELECT	*
			FROM	".self::getDatabaseTableName()."
			WHERE	name = ?";
		$statement = WCF::getDB()->prepareStatement($sql);
		$statement->execute(array($characterName));
		$row = $statement->fetchArray();
		if (!$row) $row = array();
		
		return new Character(null, $row);
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
	 * Returns UserProfile object.
	 *
	 * @return	\wcf\data\user\UserProfile
	 */
	public function getUserProfile() {
		if ($this->user === null) {
			$this->user = new UserProfile(new User($this->userID));
		}

		return $this->user;
	}

	/**
	 * Returns Guild.
	 *
	 * @return	\gms\data\guild\Guild
	 */
	public function getGuild() {
		if ($this->guild === null) {
			$this->guild = new Guild($this->guildID);
		}

		return $this->guild;
	}

	/**
	 * Returns Character Rank object.
	 *
	 * @return	\gms\data\character\rank\CharacterRank
	 */
	public function getRank() {
		if ($this->rank === null) {
			$this->rank = new CharacterRank($this->rankID);
		}

		return $this->rank;
	}

	/**
	 * Returns primary class of character.
	 *
	 * @todo implement primary class
	 * @return	null
	 */
	public function getPrimaryClass() {
		return null;
	}

	/**
	 * Returns true if character can be edit by current user.
	 *
	 * @return	bool
	 */
	public function canEdit() {
		return (WCF::getUser()->userID == $this->userID);
	}
}
