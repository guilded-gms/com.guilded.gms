<?php
namespace gms\system\menu\character\profile\content;
use gms\data\character\Character;
use wcf\system\SingletonFactory;

class GameCharacterProfileMenuContent extends SingletonFactory implements ICharacterProfileMenuContent {
	/**
	 * @see	\wcf\system\menu\character\profile\content\ICharacterProfileMenuContent::getNumberOfItems()
	 */
	public function getNumberOfItems(Character $character) {
		return 0;
	}

	/**
	 * @see	\wcf\system\menu\character\profile\content\ICharacterProfileMenuContent::isAccessible()
	 */
	public function isAccessible(Character $character) {
		if (!$this->checkGame($character->getGame())) {
			return false;
		}

		return (WCF::getSession()->getPermission('user.character.canViewProfile'));
	}

	/**
	 * @see	\wcf\system\menu\character\profile\content\ICharacterProfileMenuContent::getContent()
	 */
	public function getContent(Character $character) {
		return '';
	}

	/**
	 * Checks given game of availability.
	 *
	 * @param Game $game
	 * @return	boolean
	 */
	public function checkGame(Game $game) {
		return ($game->title != 'wow'); // @todo check by get_called_class() and namespace
	}
}
