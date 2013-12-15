<?php
namespace gms\system\dashboard\box;
use wcf\data\dashboard\box\DashboardBox;
use wcf\page\IPage;
use wcf\system\WCF;

/**
 * DashboardBox for showing server status.
 *
 * @author	Jeffrey Reichardt
 * @copyright	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	system.dashboard.box
 * @category	Guilded 2.0
 */
class GameServerStatusDashboardBox extends AbstractSidebarDashboardBox {
	/**
	 * game server list
	 * @var	\gms\data\game\server\GameServerList
	 */
	public $serverList = null;
	
	/**
	 * @see	\wcf\system\dashboard\box\IDashboardBox::init()
	 */
	public function init(DashboardBox $box, IPage $page) {
		parent::init($box, $page);

		// @todo get only realms of active guilds
		$this->serverList = new GameServerList();
		$this->serverList->sqlOrderBy = 'game_server.gameID, game_server.name';
		$this->serverList->readObjects();
		
		$this->fetched();
	}
	
	/**
	 * @see	\wcf\system\dashboard\box\AbstractContentDashboardBox::render()
	 */
	protected function render() {
		if (!count($this->serverList)) {
			return '';
		}
		
		WCF::getTPL()->assign(array(
			'serverList' => $this->serverList
		));
		
		return WCF::getTPL()->fetch('dashboardBoxGameServerStatus');
	}
}
