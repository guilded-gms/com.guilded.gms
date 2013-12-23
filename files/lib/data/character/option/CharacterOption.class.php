<?php
namespace gms\data\character\option;
use gms\data\character\Character;
use gms\data\GMSDatabaseObject;

/**
 * Represents a character option.
 * 
 * @author	Jeffrey Reichardt
 * @copyright	2012-2013 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	data.character.option
 * @category	Guilded 2.0
 */
class CharacterOption extends GMSDatabaseObject {
	/**
	 * @see	\wcf\data\DatabaseObject::$databaseTableName
	 */
	protected static $databaseTableName = 'character_option';
	
	/**
	 * @see	\wcf\data\DatabaseObject::$databaseTableIndexName
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
	 * @var	\gms\data\character\Character
	 */
	public $character = null;
	
	/**
	 * Sets target character object.
	 * 
	 * @param	\gms\data\character\Character	$character
	 */
	public function setCharacter(Character $character) {
		$this->character = $character;
	}
	
	/**
	 * @see	\wcf\data\option\Option::isVisible()
	 */
	public function isVisible() {
		/*
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
		*/
		return true;
	}
}
