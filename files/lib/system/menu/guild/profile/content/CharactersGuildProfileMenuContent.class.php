<?php
namespace wcf\system\menu\guild\profile\content;
use wcf\data\guild\Guild;
use wcf\system\SingletonFactory;
use wcf\system\WCF;

class CharactersGuildProfileMenuContent extends SingletonFactory implements IGuildProfileMenuContent {	
	/**
	 * @see	wcf\system\menu\guild\profile\content\IGuildProfileMenuContent::getContent()
	 */
	public function getContent($guildID) {
		$guild = new Guild($guildID);
		
		WCF::getTPL()->assign(array(
			'characters' => $guild->getCharacters(),
			'guildID' => $guild->guildID,
		));
		
		return WCF::getTPL()->fetch('guildProfileCharacters');
	}
}
