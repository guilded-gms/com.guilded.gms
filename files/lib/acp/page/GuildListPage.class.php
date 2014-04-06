<?php
namespace gms\acp\page;
use wcf\page\SortablePage;
use wcf\system\WCF;

/**
 * Shows guilds.
 */
class GuildListPage extends SortablePage {
	/**
	 * @see	\wcf\page\AbstractPage::$neededPermissions
	 */
	public $neededPermissions = array('admin.gms.guild.canManage');
	
	/**
	 * @see	\wcf\page\SortablePage::$defaultSortField
	 */
	public $defaultSortField = 'name';

	/**
	 * @see	\wcf\page\AbstractPage::$activeMenuItem
	 */
	public $activeMenuItem = 'gms.acp.menu.link.gms.guild.list';
	
	/**
	 * @see	\wcf\page\SortablePage::$validSortFields
	 */
	public $validSortFields = array('guildID', 'name', 'gameID');
	
	/**
	 * @see	\wcf\page\MultipleLinkPage::$objectListClassName
	 */
	public $objectListClassName = 'gms\data\guild\GuildList';
	
	/**
	 * @see	\wcf\page\MultipleLinkPage::initObjectList()
	 */
	public function initObjectList() {
		parent::initObjectList();
		
		$this->sqlOrderBy = "guild.".$this->sortField." ".$this->sortOrder;
	}

	/**
	 * @see	\wcf\page\IPage::assignVariables()
	 */
	public function assignVariables() {
		parent::assignVariables();

		WCF::getTPL()->assign(array(
			'isPublic' => true
		));
	}
}
