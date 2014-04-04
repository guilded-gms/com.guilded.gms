<?php
namespace gms\acp\page;
use wcf\page\SortablePage;

/**
 * Shows guild ranks.
 */
class GuildRankListPage extends SortablePage {
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
	public $activeMenuItem = 'gms.acp.menu.link.gms.guild.rank.list';
	
	/**
	 * @see	\wcf\page\SortablePage::$validSortFields
	 */
	public $validSortFields = array('guildID', 'name', 'rankID');
	
	/**
	 * @see	\wcf\page\MultipleLinkPage::$objectListClassName
	 */
	public $objectListClassName = 'gms\data\guild\rank\GuildRankList';
}
