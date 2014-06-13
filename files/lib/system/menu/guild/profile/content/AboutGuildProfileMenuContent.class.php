<?php
namespace gms\system\menu\guild\profile\content;
use gms\data\guild\Guild;
use gms\system\option\guild\GuildOptionHandler;
use wcf\system\event\EventHandler;
use wcf\system\SingletonFactory;
use wcf\system\WCF;

class AboutGuildProfileMenuContent extends SingletonFactory implements IGuildProfileMenuContent {
	/**
	 * guild option handler object
	 * @var	\gms\system\option\guild\GuildOptionHandler
	 */
	public $optionHandler = null;
	
	/**
	 * @see	\wcf\system\SingletonFactory::init()
	 */
	protected function init() {
		EventHandler::getInstance()->fireAction($this, 'shouldInit');
		
		$this->optionHandler = new GuildOptionHandler(false, false, 'profile');
		$this->optionHandler->showEmptyOptions(true);
		
		EventHandler::getInstance()->fireAction($this, 'didInit');
	}

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
		$this->optionHandler->setGuild($guild);
		
		return WCF::getTPL()->fetch('guildProfileAbout', 'gms', array(
			'options' => $this->optionHandler->getOptionTree(),
			'guildID' => $guild->guildID,
		));
	}
}
