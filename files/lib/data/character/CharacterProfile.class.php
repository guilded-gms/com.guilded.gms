<?php
namespace gms\data\character;
use wcf\data\DatabaseObjectDecorator;
use wcf\data\user\User;
use wcf\data\user\UserProfile;
use wcf\system\breadcrumb\Breadcrumb;
use wcf\system\breadcrumb\IBreadcrumbProvider;
use wcf\system\request\LinkHandler;

/**
 * Decorates the character object and provides functions to retrieve data for character profiles.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
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
	 * @see	\wcf\data\DatabaseObjectDecorator::$baseClass
	 */
	protected static $baseClass = 'gms\data\character\Character';

	/**
	 * cached list of character profiles
	 * @var	array<\gms\data\character\CharacterProfile>
	 */
	protected static $characterProfiles = array();

	/**
	 * user profile object
	 * @var	\wcf\data\user\UserProfile
	 */
	protected $userProfile = null;
	
	/**
	 * Returns a CharacterProfile object by given id
	 * 
	 * @param	integer	$characterID
	 * @return	\gms\data\character\CharacterProfile
	 */
	public static function getCharacterProfile($characterID) {
		$characters = self::getCharacterProfiles(array($characterID));
		
		return (isset($characters[$characterID]) ? $characters[$characterID] : null);
	}
	
	/**
	 * Returns a list of character profiles.
	 * 
	 * @param	array	$characterIDs
	 * @return	array<\gms\data\character\CharacterProfile>
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
				self::$characterProfiles[$character->characterID] = $character;
				$characters[$character->characterID] = $character;
			}
		}
		
		return $characters;
	}	
	
	/**
	 * @see	\wcf\system\breadcrumb\IBreadcrumbProvider::getBreadcrumb()
	 */
	public function getBreadcrumb() {
		return new Breadcrumb($this->name, LinkHandler::getInstance()->getLink('Character', array(
			'object' => $this
		)));
	}

	/**
	 * Returns the user profile object.
	 *
	 * @return	\wcf\data\user\UserProfile
	 */
	public function getUserProfile() {
		if ($this->userProfile === null) {
			$this->userProfile = new UserProfile(new User($this->getDecoratedObject()->userID));
		}

		return $this->userProfile;
	}
}
