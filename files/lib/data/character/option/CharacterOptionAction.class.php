<?php
namespace gms\data\character\option;
use gms\data\game\Game;
use wcf\data\AbstractDatabaseObjectAction;
use wcf\system\exception\IllegalLinkException;
use wcf\system\option\character\CharacterOptionHandler;
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
	 * Returns options output by given game.
	 *
	 * @return array
	 * @throws \wcf\system\exception\IllegalLinkException
	 */
	public function getOptions() {
		if (!isset($this->parameters['gameID'])) {
			return array();
		}

		$game = new Game($this->parameters['gameID']);
		if (!$game->gameID) {
			throw new IllegalLinkException();
		}

		$optionHandler = new CharacterOptionHandler(false);
		$optionHandler->init();
		$optionHandler->setGame($game);

		// assign vars
		WCF::getTPL()->assign(array(
			'optionTree' => $optionHandler->getOptionTree()
		));

		return array(
			'template' => WCF::getTPL()->fetch('characterOptions')
		);
	}
}
