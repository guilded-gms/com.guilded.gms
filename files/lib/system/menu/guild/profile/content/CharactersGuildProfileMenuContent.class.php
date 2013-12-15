<?php
namespace gms\system\menu\guild\profile\content;
use gms\data\guild\Guild;
use wcf\system\SingletonFactory;
use wcf\system\WCF;

class CharactersGuildProfileMenuContent extends SingletonFactory implements IGuildProfileMenuContent {
	/**
	 * @see	\wcf\system\menu\guild\profile\content\IGuildProfileMenuContent::getNumberOfItems()
	 */
	public function getNumberOfItems(Guild $guild) {
		return count($guild->getCharacters());
	}

	/**
	 * @see	\wcf\system\menu\guild\profile\content\IGuildProfileMenuContent::isAccessible()
	 */
	public function isAccessible(Guild $guild) {
		return (WCF::getSession()->getPermission('user.guild.canViewProfile'));
	}

	/**
	 * @see	\wcf\system\menu\guild\profile\content\IGuildProfileMenuContent::getContent()
	 */
	public function getContent(Guild $guild) {
		WCF::getTPL()->assign(array(
			'characters' => $guild->getCharacters(),
			'guildID' => $guild->guildID,
		));
		
		return WCF::getTPL()->fetch('guildProfileCharacters');
	}
}
