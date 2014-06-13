<?php
namespace gms\system\menu\guild\profile\content;
use gms\data\guild\Guild;
use wcf\system\SingletonFactory;
use wcf\system\WCF;

class InstanceProgressGuildProfileMenuContent extends SingletonFactory implements IGuildProfileMenuContent {
	/**
	 * @see	\wcf\system\menu\guild\profile\content\IGuildProfileMenuContent::getNumberOfItems()
	 */
	public function getNumberOfItems(Guild $guild) {
		return 0;
	}

	/**
	 * @see	\wcf\system\menu\guild\profile\content\IGuildProfileMenuContent::isAccessible()
	 */
	public function isAccessible(Guild $guild) {
		return (WCF::getSession()->getPermission('user.gms.guild.canView'));
	}

	/**
	 * @see	\wcf\system\menu\guild\profile\content\IGuildProfileMenuContent::getContent()
	 */
	public function getContent(Guild $guild) {
		return WCF::getTPL()->fetch('guildProfileInstanceProgress', 'gms', array(
			'guildID' => $guild->guildID
		));
	}
}
