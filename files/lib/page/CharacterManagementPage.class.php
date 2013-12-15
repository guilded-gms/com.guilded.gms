<?php
namespace gms\page;
use gms\data\character\CharacterList;
use gms\data\game\GameList;
use wcf\system\exception\PermissionDeniedException;
use wcf\system\menu\user\UserMenu;
use wcf\system\WCF;

/**
 * Shows a list of characters in user profile management.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2013 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	page
 * @category	Guilded 2.0
 */
class CharacterManagementPage extends AbstractPage {
	/**
	 * list of characters
	 * @var array<\gms\data\character\Character>
	 */
	protected $characters = array();

	/**
	 * list of games
	 * @var array<\gms\data\game\Game>
	 */
	protected $games = array();

	/**
	 * @see	\wcf\page\IPage::readData()
	 */
	public function readData() {
		parent::readData();

		//get characters
		$characterList = new CharacterList();
		$characterList->getConditionBuilder()->add('userID = ?', array(WCF::getUser()->userID));
		$characterList->readObjects();
		$this->characters = $characterList->getObjects();

		//get games
		$gameList = new GameList();
		$gameList->readObjects();
		$this->games = $gameList->getObjects();
	}

	/**
	 * @see	\wcf\page\IPage::assignVariables()
	 */
	public function assignVariables() {
		parent::assignVariables();

		WCF::getTPL()->assign(array(
			'characters' => $this->characters,
			'games' => $this->games
		));
	}

	/**
	 * @see	\wcf\page\IPage::show()
	 */
	public function show() {
		if (!WCF::getUser()->userID) {
			throw new PermissionDeniedException();
		}

		// set active tab
		UserMenu::getInstance()->setActiveMenuItem('wcf.user.menu.profile.character');

		parent::show();
	}
}
