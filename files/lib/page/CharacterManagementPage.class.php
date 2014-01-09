<?php
namespace gms\page;
use gms\data\character\CharacterList;
use gms\data\game\GameList;
use wcf\page\AbstractPage;
use wcf\system\exception\PermissionDeniedException;
use wcf\system\menu\user\UserMenu;
use wcf\system\WCF;

/**
 * Shows a list of characters in user profile management.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	page
 * @category	Guilded 2.0
 */
class CharacterManagementPage extends AbstractPage {
	/**
	 * @see	\wcf\page\AbstractPage::$neededPermissions
	 */
	public $neededPermissions = array('user.gms.character.canManage');

	/**
	 * list of characters
	 * @var \gms\data\character\CharacterList
	 */
	protected $characterList = array();

	/**
	 * list of games
	 * @var \gms\data\game\GameList
	 */
	protected $gameList = array();

	/**
	 * @see	\wcf\page\IPage::readData()
	 */
	public function readData() {
		parent::readData();

		//get characters
		$this->characterList = new CharacterList();
		$this->characterList->getConditionBuilder()->add('userID = ?', array(WCF::getUser()->userID));
		$this->characterList->readObjects();

		//get games
		$this->gameList = new GameList();
		$this->gameList->readObjects();
	}

	/**
	 * @see	\wcf\page\IPage::assignVariables()
	 */
	public function assignVariables() {
		parent::assignVariables();

		WCF::getTPL()->assign(array(
			'characters' => $this->characterList,
			'games' => $this->gameList
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
