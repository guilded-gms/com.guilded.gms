<?php
namespace gms\data\character;
use wcf\system\exception\ValidateActionException;
use wcf\system\WCF;

/**
 * CharacterProfile-related actions.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	data.character
 * @category	Guilded 2.0
 */
class CharacterProfileAction extends CharacterAction {
	/**
	 * @see	\wcf\data\AbstractDatabaseObjectAction::$allowGuestAccess
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

		return array(
			'template' => WCF::getTPL()->fetch('characterProfilePreview', 'gms', array(
				'character' => CharacterProfile::getCharacterProfile($characterID)
			))
		);
	}
}
