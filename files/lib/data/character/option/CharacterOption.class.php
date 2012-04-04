<?php
namespace wcf\data\character\option;
use wcf\data\option\Option;
use wcf\data\character\Character;
use wcf\system\option\character\ICharacterOptionOutput;
use wcf\system\WCF;

/**
 * Represents a character option.
 * 
 * @author 		Jeffrey Reichardt
 * @copyright	2012 Guilded.eu
 * @license		CC by-nc-sa
 * @package	com.guilded.wcf.character
 * @subpackage	data.character.option
 * @category 	Community Framework
 */
class CharacterOption extends Option {
	/**
	 * @see	wcf\data\DatabaseObject::$databaseTableName
	 */
	protected static $databaseTableName = 'character_option';
	
	/**
	 * @see	wcf\data\DatabaseObject::$databaseTableIndexName
	 */
	protected static $databaseTableIndexName = 'optionID';
	
	/**
	 * option value
	 * @var	string
	 */
	public $optionValue = '';
	
	/**
	 * output data
	 * @var	array
	 */
	public $outputData = array();
	
	/**
	 * character object
	 * @var	wcf\data\character\Character
	 */
	public $character = null;
	
	/**
	 * Sets target character object.
	 * 
	 * @param	wcf\data\character\Character	$character
	 */
	public function setCharacter(Character $character) {
		$this->character = $character;
	}
	
	/**
	 * @see	wcf\data\option\Option::isVisible()
	 */
	public function isVisible() {
		// check if option is hidden
		if (!$this->visible) {
			return false;
		}
		
		// proceed if option is visible for all
		if ($this->visible & Option::VISIBILITY_GUEST) {
			$visible = true;
		}
		// proceed if option is visible for registered characters and current character is logged in
		else if (($this->visible & Option::VISIBILITY_REGISTERED) && WCF::getCharacter()->characterID) {
			$visible = true;
		}
		else {
			$isAdmin = $isOwner = $visible = false;
			// check admin permissions
			if ($this->visible & Option::VISIBILITY_ADMINISTRATOR) {
				if (WCF::getSession()->getPermission('admin.general.canViewPrivateCharacterOptions')) {
					$isAdmin = true;
				}
			}
			
			// check owner state
			if ($this->visible & Option::VISIBILITY_OWNER) {
				if ($this->character !== null && $this->character->characterID == WCF::getCharacter()->characterID) {
					$isOwner = true;
				}
			}
			
			if ($isAdmin) {
				$visible = true;
			}
			else if ($isOwner) {
				$visible = true;
			}
		}
		
		if (!$visible || $this->disabled) return false;
		
		return true;
	}
}
