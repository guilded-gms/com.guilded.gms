<?php
namespace wcf\data\character;
use wcf\system\exception\ValidateActionException;
use wcf\system\WCF;
use wcf\util\StringUtil;

class CharacterProfileAction extends CharacterAction {
	/**
	 * @see	wcf\data\AbstractDatabaseObjectAction::$allowGuestAccess
	 */
	protected $allowGuestAccess = array('getCharacterProfile');
		
	/**
	 * Validates character profile preview.
	 */
	public function validateGetCharacterProfile() {
		switch (count($this->objectIDs)) {
			case 0:
				throw new ValidateActionException("Missing character id");
			break;
			case 1:
				return;
			break;
			default:
				// more than one character id is pointless
				throw new ValidateActionException("Invalid parameter for character id given");
			break;
		}
	}
	
	/**
	 * Returns character profile preview.
	 * 
	 * @return	array
	 */
	public function getCharacterProfile() {
		$characterID = reset($this->objectIDs);
		
		$characterProfileList = new CharacterProfileList();
		$characterProfileList->getConditionBuilder()->add("character_table.characterID = ?", array($characterID));
		$characterProfileList->readObjects();
		$characterProfiles = $characterProfileList->getObjects();
		
		WCF::getTPL()->assign(array(
			'character' => reset($characterProfiles)
		));
		
		return array(
			'template' => WCF::getTPL()->fetch('characterProfilePreview')
		);
	}
}