<?php
namespace wcf\data\guild\profile\menu\item;
use wcf\data\AbstractDatabaseObjectAction;
use wcf\system\exception\GuildInputException;
use wcf\system\menu\guild\profile\GuildProfileMenu;

/**
 * Executes guild profile menu item-related actions.
 */
class GuildProfileMenuItemAction extends AbstractDatabaseObjectAction {
	/**
	 * @see	wcf\data\AbstractDatabaseObjectAction::$allowGuestAccess
	 */
	protected $allowGuestAccess = array('getContent');
	
	/**
	 * menu item
	 * @var	wcf\data\guild\profile\menu\item\GuildProfileMenuItem
	 */
	protected $menuItem = null;
	
	/**
	 * Validates menu item.
	 */
	public function validateGetContent() {
		if (isset($this->parameters['data']['menuItem'])) {
			$this->menuItem = GuildProfileMenu::getInstance()->getMenuItem($this->parameters['data']['menuItem']);
		}
		
		if ($this->menuItem === null) {
			throw new GuildInputException('menuItem');
		}
	}
	
	/**
	 * Returns content for given menu item.
	 */
	public function getContent() {
		$contentManager = $this->menuItem->getContentManager();
		
		return array(
			'containerID' => $this->parameters['data']['containerID'],
			'template' => $contentManager->getContent($this->parameters['data']['guildID'])
		);
	}
}
