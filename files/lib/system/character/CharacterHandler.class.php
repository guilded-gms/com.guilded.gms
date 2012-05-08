<?php
namespace wcf\system\character;
use wcf\data\character\Character;
use wcf\data\character\CharacterProfileList;
use wcf\system\SingletonFactory;
use wcf\system\WCF;

class CharacterHandler extends SingletonFactory {
	/**
	 * list of character objects
	 */
	protected $characterList = null;

	/**
	 * Returns list of user characters.
	 */
	public function getCharacters() {
		if($this->characterList === null) {
			$this->characterList = new CharacterProfileList();
			$this->characterList->sqlLimit = 0;
			$this->characterList->getConditionBuilder()->add('character.userID = ?', array(WCF::getUser()->userID));
			$this->characterList->readObjects();
		}
		
		return $this->characterList->getObjects();
	}
	
	/**
	 * Returns primary character.
	 */
	public function getPrimaryCharacter() {
		foreach ($this->getCharacters() as $character) {
			if ($character->isPrimary) {
				return $character;
			}
		}
	
		return null;
	}
}
