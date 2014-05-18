<?php
namespace gms\system\dashboard\box;
use gms\data\guild\recruitment\tender\GuildRecruitmentTenderList;
use gms\page\GuildPage;
use wcf\data\dashboard\box\DashboardBox;
use wcf\page\IPage;
use wcf\system\dashboard\box\AbstractSidebarDashboardBox;
use wcf\system\WCF;

/**
 * DashboardBox for recruitment tender.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	system.dashboard.box
 * @category	Guilded 2.0
 */
class GuildRecruitmentDashboardBox extends AbstractSidebarDashboardBox {
	/**
	 * game server list
	 * @var	\gms\data\guild\recruitment\tender\GuildRecruitmentTenderList
	 */
	public $tenderList = null;
	
	/**
	 * @see	\wcf\system\dashboard\box\IDashboardBox::init()
	 */
	public function init(DashboardBox $box, IPage $page) {
		parent::init($box, $page);

		$this->tenderList = new GuildRecruitmentTenderList();

		// show specific tenders for guild
		if ($page instanceof GuildPage && $page->guild !== null) {
			$this->tenderList->getConditionBuilder()->add('guild_recruitment_tender.guildID = ?', array($page->guild->guildID));
		}
		else {
			$this->tenderList->sqlJoins .= 'INNER JOIN gms'.WCF_N.'_guild guild ON (guild.guildID = guild_recruitment_tender.guildID)';
			$this->tenderList->getConditionBuilder()->add('guild.isPublic = ?', array(1));
		}

		$this->tenderList->readObjects();
		
		$this->fetched();
	}
	
	/**
	 * @see	\wcf\system\dashboard\box\AbstractContentDashboardBox::render()
	 */
	protected function render() {
		if (!count($this->tenderList)) {
			return '';
		}
		
		WCF::getTPL()->assign(array(
			'tenderList' => $this->tenderList
		));
		
		return WCF::getTPL()->fetch('dashboardBoxGuildRecruitment');
	}
}
