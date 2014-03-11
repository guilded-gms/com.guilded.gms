<?php
namespace gms\data\character\option;
use gms\data\game\Game;
use gms\system\option\character\CharacterOptionHandler;
use wcf\data\AbstractDatabaseObjectAction;
use wcf\system\exception\IllegalLinkException;
use wcf\system\WCF;

/**
 * Executes character option-related actions.
 * 
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	data.character.option
 * @category	Guilded 2.0
 */
class CharacterOptionAction extends AbstractDatabaseObjectAction {
	/**
	 * @see	\wcf\data\AbstractDatabaseObjectAction::$className
	 */
	protected $className = 'gms\data\character\option\CharacterOptionEditor';

	/**
	 * @see	\wcf\data\AbstractDatabaseObjectAction::$permissionsCreate
	 */
	protected $permissionsCreate = array('user.gms.character.canManage');

	/**
	 * @see	\wcf\data\AbstractDatabaseObjectAction::$permissionsDelete
	 */
	protected $permissionsDelete = array('user.gms.character.canManage');

	/**
	 * @see	\wcf\data\AbstractDatabaseObjectAction::$permissionsUpdate
	 */
	protected $permissionsUpdate = array('user.gms.character.canManage');

	/**
	 * @see	\wcf\data\AbstractDatabaseObjectAction::$allowGuestAccess
	 */
	protected $allowGuestAccess = array('getOptions');

	/**
	 * guild object
	 * @var	\gms\data\guild\Guild
	 */
	protected $game = null;

	/**
	 * Validates menu item.
	 */
	public function validateGetOptions() {
		// read parameters
		$this->readInteger('gameID', false, 'data');

		// get game
		$this->game = new Game($this->parameters['data']['gameID']);
		if (!$this->game->gameID) {
			throw new IllegalLinkException();
		}
	}

	/**
	 * Returns options output by given game.
	 *
	 * @return array
	 * @throws \wcf\system\exception\IllegalLinkException
	 */
	public function getOptions() {
		$optionHandler = new CharacterOptionHandler(false);
		$optionHandler->init();
		$optionHandler->setGame($this->game);

		return array(
			'template' => WCF::getTPL()->fetch('characterOptions', 'gms', array(
				'errorType' => array(),
				'optionTree' => $optionHandler->getOptionTree()
			))
		);
	}
}
