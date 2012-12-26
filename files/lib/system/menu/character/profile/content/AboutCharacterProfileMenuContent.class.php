<?php
namespace wcf\system\menu\character\profile\content;
use wcf\data\character\Character;
use wcf\system\event\EventHandler;
use wcf\system\option\character\CharacterOptionHandler;
use wcf\system\SingletonFactory;
use wcf\system\WCF;

class AboutCharacterProfileMenuContent extends SingletonFactory implements ICharacterProfileMenuContent {
	/**
	 * cache name
	 * @var	string
	 */
	public $cacheName = 'characterOption';
	
	/**
	 * cache class name
	 * @var	string
	 */
	public $cacheClass = 'wcf\system\cache\builder\OptionCacheBuilder';
	
	/**
	 * character option handler object
	 * @var	wcf\system\option\character\CharacterOptionHandler
	 */
	public $optionHandler = null;
	
	/**
	 * @see	wcf\system\SingletonFactory::init()
	 */
	protected function init() {
		EventHandler::getInstance()->fireAction($this, 'shouldInit');
		
		$this->optionHandler = new CharacterOptionHandler($this->cacheName, $this->cacheClass, false, '', 'profile');
		$this->optionHandler->enableEditMode(false);
		$this->optionHandler->showEmptyOptions(false);
		
		EventHandler::getInstance()->fireAction($this, 'didInit');
	}
	
	/**
	 * @see	wcf\system\menu\character\profile\content\ICharacterProfileMenuContent::getContent()
	 */
	public function getContent($characterID) {
		$character = new Character($characterID);
		$this->optionHandler->setCharacter($character);
		
		WCF::getTPL()->assign(array(
			'options' => $this->optionHandler->getOptionTree(),
			'characterID' => $character->characterID,
		));
		
		return WCF::getTPL()->fetch('characterProfileAbout');
	}
}
