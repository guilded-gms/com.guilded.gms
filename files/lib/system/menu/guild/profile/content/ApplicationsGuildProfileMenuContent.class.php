<?php
namespace gms\system\menu\guild\profile\content;
use gms\data\guild\Guild;
use wcf\system\SingletonFactory;
use wcf\system\WCF;

class ApplicationsGuildProfileMenuContent extends SingletonFactory implements IGuildProfileMenuContent {
	/**
	 * @see	\wcf\system\menu\guild\profile\content\IGuildProfileMenuContent::getNumberOfItems()
	 */
	public function getNumberOfItems(Guild $guild) {
		return count($guild->getApplications());
	}

	/**
	 * @see	\wcf\system\menu\guild\profile\content\IGuildProfileMenuContent::isAccessible()
	 */
	public function isAccessible(Guild $guild) {
		return $guild->canViewInternal();
	}

	/**
	 * @see	\wcf\system\menu\guild\profile\content\IGuildProfileMenuContent::getContent()
	 */
	public function getContent(Guild $guild) {
		return WCF::getTPL()->fetch('guildProfileApplications', 'gms', array(
			'applications' => $guild->getApplications(),
			'guildID' => $guild->guildID,
		));
	}
}
