<?php
namespace gms\data\character\option;
use gms\data\character\Character;
use wcf\data\option\Option;
use wcf\system\WCF;

/**
 * Represents a character option.
 * 
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	data.character.option
 * @category	Guilded 2.0
 */
class CharacterOption extends Option {
	/**
	 * @see	\wcf\data\DatabaseObject::$databaseTableName
	 */
	protected static $databaseTableName = 'character_option';
	
	/**
	 * @see	\wcf\data\DatabaseObject::$databaseTableIndexName
	 */
	protected static $databaseTableIndexName = 'optionID';

	/**
	 * character object
	 * @var	\gms\data\character\Character
	 */
	public $character = null;

	/**
	 * @see	\wcf\data\IStorableObject::getDatabaseTableName()
	 */
	public static function getDatabaseTableName() {
		return 'gms'.WCF_N.'_'.static::$databaseTableName;
	}

	/**
	 * Sets target character object.
	 * 
	 * @param	\gms\data\character\Character	$character
	 */
	public function setCharacter(Character $character) {
		$this->character = $character;
	}

	/**
	 * @see	\wcf\data\option\Option::getOptions()
	 */
	public static function getOptions() {
		$sql = "SELECT	*
				FROM	gms".WCF_N."_character_option";
		$statement = WCF::getDB()->prepareStatement($sql);
		$statement->execute();

		$options = array();

		while ($row = $statement->fetchArray()) {
			$option = new CharacterOption(null, $row);
			$options[$option->optionID] = $option;
		}

		return $options;
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
