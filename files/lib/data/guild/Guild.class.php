<?php
namespace wcf\data\guild;
use wcf\data\DatabaseObject;
use wcf\system\request\IRouteController;
use wcf\system\WCF;

class Guild extends DatabaseObject implements IRouteController{
	/**
	 * @see	wcf\data\DatabaseObject::$databaseTableName
	 */
	protected static $databaseTableName = 'guild';
	
	/**
	 * @see	wcf\data\DatabaseObject::$databaseTableIndexName
	 */
	protected static $databaseTableIndexName = 'guildID';

	/**
	 * List of guild members.
	 */
	protected $characters = array();
	
	
	/**
	 * @see	wcf\system\request\IRouteController::getID()
	 */
	public function getID() {
		return $this->guildID;
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
	public function getCharacters() {
		if (!count($this->characters)) {
			$characterList = new CharacterList;
			$characterList->getConditionBuilder()->add('guildID = ?', array($this->guildID));
			$characterList->readObjects();
			
			$this->characters = $characterList->getObjects();
		}
		
		return $this->characters;
	}
}
