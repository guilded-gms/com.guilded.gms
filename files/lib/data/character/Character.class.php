<?php
namespace wcf\data\character;
use wcf\data\DatabaseObject;
use wcf\data\game\Game;
use wcf\system\api\rest\response\IRESTfulResponse;
use wcf\system\request\IRouteController;
use wcf\system\WCF;

/**
 * Represents a character.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2013 DevLabor UG (haftungsbeschränkt)
 * @license	CC BY-NC-SA 3.0 <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.wcf.character
 * @subpackage	data.character
 * @category	Guilded 2.0
*/
class Character extends DatabaseObject implements IRESTfulResponse, IRouteController {
	/**
	 * @see	wcf\data\DatabaseObject::$databaseTableName
	 */
	protected static $databaseTableName = 'character';
	
	/**
	 * @see	wcf\data\DatabaseObject::$databaseTableIndexName
	 */
	protected static $databaseTableIndexName = 'characterID';
	
	/**
	 * game object
	 * @type wcf\data\game\Game
	 */
	protected $game = null;	
	
	/**
	 * userprofile object
	 * @type wcf\data\user\UserProfile
	 */
	protected $user = null;

	/**
	 * @see	wcf\data\IStorableObject::getDatabaseTableAlias()
	 */
	public static function getDatabaseTableAlias() {
		return static::$databaseTableName.'_table';
	}
	
	/**
	 * @see	wcf\system\request\IRouteController::getTitle()
	 */
	public function getTitle() {
		return $this->name;
	}
	
	/**
	 * Returns Character-object by characterName.
	 *
	 * @param	string		$characterName
	 * @return	User
	 */
	public static function getCharacterByName($characterName) {
		$sql = "SELECT	*
			FROM	wcf".WCF_N."_character
			WHERE	name = ?";
		$statement = WCF::getDB()->prepareStatement($sql);
		$statement->execute(array($username));
		$row = $statement->fetchArray();
		if (!$row) $row = array();
		
		return new Character(null, $row);
	}	
	
	/**
	 * Returns game object.
	 *
	 * @return	wcf\data\game\Game
	 */
	public function getGame() {
		if($this->game === null) {
			$this->game = new Game($this->gameID);
		}
		
		return $this->game;
	}
	
	/**
	 * Returns UserProfile object.
	 *
	 * @return	wcf\data\user\UserProfile
	 */
	public function getUser() {
		if($this->user === null) {
			$this->user = new UserProfile(new User($this->userID));
		}
		
		return $this->user;
	}

	/**
	 * @see	IRESTfulResponse::getResponseFields()
	 */
	public function getResponseFields() {
		return array_keys($this->data);
	}
}
