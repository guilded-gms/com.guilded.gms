<?php
namespace wcf\data\character;

/**
 * Represents a list of character profiles.
 */
class CharacterProfileList extends UserList {
	/**
	 * @see	wcf\data\DatabaseObjectList::$sqlOrderBy
	 */
	public $sqlOrderBy = 'character.characterName';
	
	/**
	 * decorator class name
	 * @var string
	 */
	public $decoratorClassName = 'wcf\data\character\CharacterProfile';
	
	/**
	 * @see	wcf\data\DatabaseObjectList::readObjects()
	 */
	public function readObjects() {
		if ($this->objectIDs === null) $this->readObjectIDs();
		parent::readObjects();
		
		foreach ($this->objects as $characterID => $character) {
			$this->objects[$characterID] = new $this->decoratorClassName($character);
		}
	}
}
