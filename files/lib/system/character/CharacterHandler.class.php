<?php
namespace wcf\system\character;
use wcf\data\character\Character;
use wcf\data\character\CharacterProfileList;
use wcf\system\SingletonFactory;
use wcf\system\WCF;

/**
 * Handler for characters
 *
 * @author 		Jeffrey Reichardt
 * @copyright	2012-2013 DevLabor Unternehmergesellschaft (haftungsbeschränkt)
 * @license		Creative Commons <BY-NC-SA> (http://creativecommons.org/licenses/by-nc-sa/3.0/legalcode)
 * @package	com.guilded.wcf.character
 * @subpackage	system.character
 * @category 	Guilded
 */
class CharacterHandler extends SingletonFactory {
	/**
	 * list of character objects
	 */
	protected $characterList = null;

	/**
	 * Returns list of user characters.
	 *
	 * @return 	array<\wcf\data\character\Character>
	 */
	public function getCharacters($gameID = 0) {
		if($this->characterList === null) {
			$this->characterList = new CharacterProfileList();
			$this->characterList->sqlLimit = 0;
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
	 * @return 	wcf\data\character\Character
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
