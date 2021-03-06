<?php
namespace gms\data\character\profile\menu\item;
use gms\data\character\Character;
use gms\system\menu\character\profile\CharacterProfileMenu;
use wcf\data\AbstractDatabaseObjectAction;
use wcf\system\exception\IllegalLinkException;
use wcf\system\exception\PermissionDeniedException;

/**
 * Executes character profile menu item-related actions.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	data.character.profile.menu.item
 * @category	Guilded 2.0
 */
class CharacterProfileMenuItemAction extends AbstractDatabaseObjectAction {
	/**
	 * @see	\wcf\data\AbstractDatabaseObjectAction::$allowGuestAccess
	 */
	protected $allowGuestAccess = array('getContent');
	
	/**
	 * menu item
	 * @var	\gms\data\character\profile\menu\item\CharacterProfileMenuItem
	 */
	protected $menuItem = null;

	/**
	 * character object
	 * @var	\gms\data\character\Character
	 */
	protected $character = null;
	
	/**
	 * Validates menu item.
	 */
	public function validateGetContent() {
		// read parameters
		$this->readString('menuItem', false, 'data');
		$this->readInteger('characterID', false, 'data');

		// get menuItem
		if (isset($this->parameters['data']['menuItem'])) {
			$this->menuItem = CharacterProfileMenu::getInstance()->getMenuItem($this->parameters['data']['menuItem']);
		}

		// get character
		$this->character = new Character($this->parameters['data']['characterID']);
		if (!$this->character->characterID) {
			throw new IllegalLinkException();
		}

		if (!$this->menuItem->getContentManager()->isAccessible($this->character)) {
			throw new PermissionDeniedException();
		}
	}
	
	/**
	 * Returns content for given menu item.
	 *
	 * @return	array
	 */
	public function getContent() {
		$contentManager = $this->menuItem->getContentManager();
		
		return array(
			'containerID' => $this->parameters['data']['containerID'],
			'template' => $contentManager->getContent($this->parameters['data']['characterID'])
		);
	}
}
