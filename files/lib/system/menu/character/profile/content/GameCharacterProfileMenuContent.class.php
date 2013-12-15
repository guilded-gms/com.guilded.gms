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
	 * @param \gms\data\game\Game $game
	 * @return	boolean
	 */
	public function checkGame(Game $game) {
		$className = get_class($this);

		$sql = "SELECT game.gameID
				FROM wcf".WCF_N."_object_type object_type
				INNER JOIN wcf".WCF_N."_game game ON (game.packageID = object_type.packageID)
				WHERE (object_type.className = ?)";
		$statement = WCF::getDB()->prepareStatement($sql);
		$statement->execute(array($className));
		$row = $statement->fetchArray();

		return ($game->gameID == $row['gameID']);
	}
}
