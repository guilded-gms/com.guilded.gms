<?php
namespace gms\system\character;
use gms\data\character\CharacterProfileList;
use wcf\system\SingletonFactory;
use wcf\system\WCF;

/**
 * Handler for characters
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2013 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons <BY-NC-SA> (http://creativecommons.org/licenses/by-nc-sa/3.0/legalcode)
 * @package	com.guilded.gms
 * @subpackage	system.character
 * @category	Guilded 2.0
 */
class CharacterHandler extends SingletonFactory {
	/**
	 * list of character objects
	 */
	protected $characterList = null;

	/**
	 * Returns list of user characters.
	 *
	 * @param	integer	$gameID
	 * @return	array
	 */
	public function getCharacters($gameID = 0) {
		if ($this->characterList === null) {
			$this->characterList = new CharacterProfileList();
			$this->characterList->getConditionBuilder()->add('character_table.userID = ?', array(WCF::getUser()->userID));
			if (!empty($gameID)) {
				$this->characterList->getConditionBuilder()->add('character_table.gameID = ?', array($gameID));
			}
			$this->characterList->readObjects();
		}
		
		return $this->characterList->getObjects();
	}

	/**
	 * Returns primary character.
	 *
	 * @param $gameID
	 * @return null
	 */
	public function getPrimaryCharacter($gameID = DEFAULT_GAME_ID) {
		foreach ($this->getCharacters() as $character) {
			if ($character->isPrimary && $character->gameID == $gameID) {
				return $character;
			}
		}
	
		return null;
	}
}
