<?php
namespace gms\system\menu\guild\profile\content;
use gms\data\guild\Guild;
use wcf\system\event\EventHandler;
use wcf\system\option\guild\GuildOptionHandler;
use wcf\system\SingletonFactory;
use wcf\system\WCF;

class AboutGuildProfileMenuContent extends SingletonFactory implements IGuildProfileMenuContent {
	/**
	 * cache name
	 * @var	string
	 */
	public $cacheName = 'guildOption';
	
	/**
	 * cache class name
	 * @var	string
	 */
	public $cacheClass = 'wcf\system\cache\builder\OptionCacheBuilder';
	
	/**
	 * guild option handler object
	 * @var	\wcf\system\option\guild\GuildOptionHandler
	 */
	public $optionHandler = null;
	
	/**
	 * @see	\wcf\system\SingletonFactory::init()
	 */
	protected function init() {
		EventHandler::getInstance()->fireAction($this, 'shouldInit');
		
		$this->optionHandler = new GuildOptionHandler($this->cacheName, $this->cacheClass, false, '', 'profile');
		$this->optionHandler->enableEditMode(false);
		$this->optionHandler->showEmptyOptions(false);
		
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
		return (WCF::getSession()->getPermission('user.guild.canViewProfile'));
	}

	/**
	 * @see	\wcf\system\menu\guild\profile\content\IGuildProfileMenuContent::getContent()
	 */
	public function getContent(Guild $guild) {
		$this->optionHandler->setGuild($guild);
		
		WCF::getTPL()->assign(array(
			'options' => $this->optionHandler->getOptionTree(),
			'guildID' => $guild->guildID,
		));
		
		return WCF::getTPL()->fetch('guildProfileAbout');
	}
}
