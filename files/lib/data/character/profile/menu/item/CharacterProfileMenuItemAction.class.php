<?php
namespace wcf\data\character\profile\menu\item;
use wcf\data\AbstractDatabaseObjectAction;
use wcf\system\exception\CharacterInputException;
use wcf\system\menu\character\profile\CharacterProfileMenu;

/**
 * Executes character profile menu item-related actions.
 */
class CharacterProfileMenuItemAction extends AbstractDatabaseObjectAction {
	/**
	 * @see	wcf\data\AbstractDatabaseObjectAction::$allowGuestAccess
	 */
	protected $allowGuestAccess = array('getContent');
	
	/**
	 * menu item
	 * @var	wcf\data\character\profile\menu\item\CharacterProfileMenuItem
	 */
	protected $menuItem = null;
	
	/**
	 * Validates menu item.
	 */
	public function validateGetContent() {
		if (isset($this->parameters['data']['menuItem'])) {
			$this->menuItem = CharacterProfileMenu::getInstance()->getMenuItem($this->parameters['data']['menuItem']);
		}
		
		if ($this->menuItem === null) {
			throw new CharacterInputException('menuItem');
		}
	}
	
	/**
	 * Returns content for given menu item.
	 */
	public function getContent() {
		$contentManager = $this->menuItem->getContentManager();
		
		return array(
			'containerID' => $this->parameters['data']['containerID'],
			'template' => $contentManager->getContent($this->parameters['data']['characterID'])
		);
	}
}
