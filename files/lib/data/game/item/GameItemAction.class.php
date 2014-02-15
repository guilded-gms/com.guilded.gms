<?php
namespace gms\data\game\item;
use gms\system\game\GameHandler;
use wcf\data\AbstractDatabaseObjectAction;
use wcf\system\exception\UserInputException;

class GameItemAction extends AbstractDatabaseObjectAction {
	/**
	 * @see	\wcf\data\AbstractDatabaseObjectAction::$className
	 */
	protected $className = 'gms\data\game\item\GameItemEditor';

	/**
	 * Validates tooltip.
	 */
	public function validateGetTooltip() {
		if (count($this->objectIDs) != 1) {
			throw new UserInputException('objectIDs');
		}
	}

	/**
	 * Returns tooltip.
	 *
	 * @return	array
	 */
	public function getTooltip() {
		$itemID = reset($this->objectIDs);
		$item = new GameItem($itemID);

		if (GameHandler::getInstance()->getTooltip() === null) {
			return array();
		}

		GameHandler::getInstance()->getTooltip()->init($item);

		return array(
			'template' => GameHandler::getInstance()->getTooltip()->getTemplate(),
			'itemID' => $itemID
		);
	}
}
