<?php
namespace wcf\data\character;
use wcf\data\DatabaseObject;
use wcf\data\game\Game;
use wcf\system\request\IRouteController;
use wcf\system\WCF;

class Character extends DatabaseObject implements IRouteController{
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
	protected $gameObject = null;

	/**
	 * @see	wcf\data\IStorableObject::getDatabaseTableAlias()
	 */
	public static function getDatabaseTableAlias() {
		return static::$databaseTableName.'_table';
	}

	/**
	 * @see	wcf\system\request\IRouteController::getID()
	 */
	public function getID() {
		return $this->characterID;
	}
	
	/**
	 * @see	wcf\system\request\IRouteController::getTitle()
	 */
	public function getTitle() {
		return $this->characterName;
	}
	
	/**
	 * Returns game object.
	 */
	public function getGame() {
		if($this->gameObject === null) {
			$this->gameObject = new Game($this->gameID);
		}
		
		return $this->gameObject;
	}
}
