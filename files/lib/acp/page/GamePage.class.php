<?php
namespace gms\acp\page;
use gms\data\game\Game;
use wcf\page\AbstractPage;
use wcf\system\WCF;

/**
 * Shows a  detailed game information.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	acp.page
 * @category	Guilded 2.0
 */
class GamePage extends AbstractPage {
	/**
	 * @see	\wcf\page\AbstractPage::$activeMenuItem
	 */
	public $activeMenuItem = 'wcf.acp.system.game';
	
	/**
	 * @see	\wcf\page\AbstractPage::$neededPermissions
	 */
	public $neededPermissions = array('admin.system.game.canManageGame');
	
	/**
	 * id of the game
	 * @var	integer
	 */
	public $gameID = 0;
	
	/**
	 * game object
	 * @var	Game
	 */
	public $game = null;
	
	/**
	 * @see	\wcf\page\IPage::readParameters()
	 */
	public function readParameters() {
		parent::readParameters();
		
		if (isset($_REQUEST['id'])) $this->gameID = intval($_REQUEST['id']);
		$this->game = new game($this->gameID);
		if (!$this->game->gameID) {
			throw new IllegalLinkException();
		}
	}
	
	/**
	 * @see	\wcf\page\IPage::assignVariables()
	 */
	public function assignVariables() {
		parent::assignVariables();
		
		WCF::getTPL()->assign(array(
			'gameID' => $this->gameID,
			'game' => $this->game
		));
	}
}
