<?php
namespace gms\system\dashboard\box;
use gms\data\game\server\GameServerList;
use gms\page\GuildPage;
use wcf\data\dashboard\box\DashboardBox;
use wcf\page\IPage;
use wcf\system\dashboard\box\AbstractSidebarDashboardBox;
use wcf\system\WCF;

/**
 * DashboardBox for showing server status.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)*
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
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

		$this->serverList = new GameServerList();

		if ($page instanceof GuildPage && $page->guild !== null) {
			// show specific server status
			$this->serverList->getConditionBuilder()->add('game_server.gameID = ?', array($page->guild->gameID));
			$this->serverList->getConditionBuilder()->add('game_server.name = ?', array($page->guild->server));
		}
		else {
			// get only realms of active guilds
			$this->serverList->sqlJoins .= 'INNER JOIN gms'.WCF_N.'_guild guild ON (guild.gameID = game_server.gameID) AND (guild.isPublic = 1)';
			$this->serverList->sqlJoins .= 'INNER JOIN gms'.WCF_N.'_guild_option_value guild_option_value ON (guild_option_value.guildID = guild.guildID)';
			$this->serverList->sqlJoins .= 'INNER JOIN gms'.WCF_N.'_guild_option guild_option ON (guild_option.optionID = guild_option_value.optionID)';
			$this->serverList->sqlOrderBy = 'game_server.gameID, game_server.name';
			$this->serverList->getConditionBuilder()->add('guild_option.optionName = ?', array('server'));
			$this->serverList->getConditionBuilder()->add('guild_option_value.optionValue = game_server.name', array());
		}

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
