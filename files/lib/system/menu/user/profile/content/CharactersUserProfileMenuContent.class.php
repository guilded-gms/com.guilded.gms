<?php
namespace gms\system\menu\user\profile\content;
use gms\data\character\CharacterList;
use gms\data\game\GameList;
use wcf\data\user\User;
use wcf\system\menu\user\profile\content\IUserProfileMenuContent;
use wcf\system\SingletonFactory;
use wcf\system\WCF;

/**
 * Extends user profile with characters.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons <BY-NC-SA> (http://creativecommons.org/licenses/by-nc-sa/3.0/legalcode)
 * @package	com.guilded.gms
 * @subpackage	system.menu.user.profile.content
 * @category	Guilded 2.0
 */
class CharactersUserProfileMenuContent extends SingletonFactory implements IUserProfileMenuContent {
	/**
	 * @see	\wcf\system\menu\user\profile\content\IUserProfileMenuContent::getContent()
	 */
	public function getContent($userID) {
		//get characters
		$characterList = new CharacterList();
		$characterList->getConditionBuilder()->add('userID = ?', array($userID));
		$characterList->readObjects();

		//get games
		$gameList = new GameList();
		$gameList->readObjects();
		
		WCF::getTPL()->assign(array(
			'games' => $gameList->getObjects(),
			'characters' => $characterList->getObjects()
		));
		
		return WCF::getTPL()->fetch('userProfileCharacters');
	}
	
	/**
	 * @see	\wcf\system\menu\user\profile\content\IUserProfileMenuContent::isVisible()
	 */
	public function isVisible($userID) {
		$user = new User($userID);
		return !($user->hideCharacters);
	}
}
