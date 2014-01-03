<?php
namespace gms\data\guild\profile\menu\item;
use gms\data\guild\Guild;
use wcf\data\AbstractDatabaseObjectAction;
use wcf\system\exception\GuildInputException;
use wcf\system\menu\guild\profile\GuildProfileMenu;

/**
 * Executes guild profile menu item-related actions.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons <BY-NC-SA> (http://creativecommons.org/licenses/by-nc-sa/3.0/legalcode)
 * @package	com.guilded.gms
 * @subpackage	data.guild.profile.menu.item
 * @category	Guilded 2.0
 */
class GuildProfileMenuItemAction extends AbstractDatabaseObjectAction {
	/**
	 * @see	\wcf\data\AbstractDatabaseObjectAction::$allowGuestAccess
	 */
	protected $allowGuestAccess = array('getContent');
	
	/**
	 * menu item
	 * @var	\gms\data\guild\profile\menu\item\GuildProfileMenuItem
	 */
	protected $menuItem = null;

	/**
	 * guild object
	 * @var	\gms\data\guild\Guild
	 */
	protected $guild = null;
	
	/**
	 * Validates menu item.
	 */
	public function validateGetContent() {
		// read parameters
		$this->readString('menuItem', false, 'data');
		$this->readInteger('guildID', false, 'data');

		// get menuItem
		if (isset($this->parameters['data']['menuItem'])) {
			$this->menuItem = GuildProfileMenu::getInstance()->getMenuItem($this->parameters['data']['menuItem']);
		}

		// get guild
		$this->guild = new Guild($this->parameters['data']['guildID']);
		if (!$this->guild->guildID) {
			throw new IllegalLinkException();
		}

		if (!$this->menuItem->getContentManager()->isAccessible($this->guild)) {
			throw new PermissionDeniedException();
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
