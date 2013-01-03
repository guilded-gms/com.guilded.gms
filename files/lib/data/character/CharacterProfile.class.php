<?php
namespace wcf\data\character;
use wcf\data\DatabaseObjectDecorator;
use wcf\system\breadcrumb\Breadcrumb;
use wcf\system\breadcrumb\IBreadcrumbProvider;
use wcf\system\request\LinkHandler;
use wcf\system\WCF;

/**
 * Decorates the character object and provides functions to retrieve data for character profiles.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2013 DevLabor UG (haftungsbeschränkt)
 * @license	CC BY-NC-SA 3.0 <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.woltlab.wcf.character
 * @subpackage	data.character
 * @category	Guilded 2.0
 */
class CharacterProfile extends DatabaseObjectDecorator implements IBreadcrumbProvider {
	/**
	 * Gender of character
	 */
	const GENDER_MALE = 1;
	const GENDER_FEMALE = 2;

	/**
	 * @see wcf\data\DatabaseObjectDecorator::$baseClass
	 */
	protected static $baseClass = 'wcf\data\character\Character';

	/**
	 * cached list of character profiles
	 * @var	array<wcf\data\character\CharacterProfile>
	 */
	protected static $characterProfiles = array();
	
	/**
	 * Returns a new CharacterProfile object by given id
	 * 
	 * @param	integer	$characterID
	 * @return	wcf\data\character\CharacterProfile	 
	 */
	public static function getCharacterProfile($characterID) {
		$characters = self::getCharacterProfiles(array($characterID));
		
		return (isset($characters[$characterID]) ? $characters[$characterID] : null);
	}
	
	/**
	 * Returns a list of character profiles.
	 * 
	 * @param	array	$userIDs
	 * @return	array<wcf\data\character\UserProfile>
	 */
	public static function getCharacterProfiles(array $characterIDs) {
		$characters = array();
		
		// check cache
		foreach ($characterIDs as $index => $characterID) {
			if (isset(self::$characterProfiles[$characterID])) {
				$characters[$characterID] = self::$characterProfiles[$characterID];
				unset($characterIDs[$index]);
			}
		}
		
		if (!empty($characterIDs)) {
			$characterList = new CharacterProfileList();
			$characterList->getConditionBuilder()->add("character_table.characterID IN (?)", array($characterIDs));
			$characterList->sqlLimit = 0;
			$characterList->readObjects();
			
			foreach ($characterList as $character) {
				$characters[$character->characterID] = $character;
			}
		}
		
		return $characters;
	}	
	
	/**
	 * @see	wcf\system\breadcrumb\IBreadcrumbProvider::getBreadcrumb()
	 */
	public function getBreadcrumb() {
		return new Breadcrumb($this->name, LinkHandler::getInstance()->getLink('Character', array(
			'object' => $this
		)));
	}	
}
