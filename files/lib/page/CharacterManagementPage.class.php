<?php
namespace wcf\page;
use wcf\data\character\CharacterList;
use wcf\data\game\GameList;
use wcf\system\exception\PermissionDeniedException;
use wcf\system\menu\user\UserMenu;
use wcf\system\WCF;

class CharacterManagementPage extends AbstractPage {
	/**
	 * list of characters
	 * @var array<wcf\data\character\Character>
	 */
	protected $characters = array();

	/**
	 * list of games
	 * @var array<wcf\data\game\Game>
	 */
	protected $games = array();

	/**
	 * @see wcf\page\IPage::readData()
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
	 * @see wcf\page\IPage::assignVariables()
	 */
	public function assignVariables() {
		parent::assignVariables();

		WCF::getTPL()->assign(array(
			'characters' => $this->characters,
            'games' => $this->games
		));
	}

    /**
     * @see wcf\page\IPage::show()
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
