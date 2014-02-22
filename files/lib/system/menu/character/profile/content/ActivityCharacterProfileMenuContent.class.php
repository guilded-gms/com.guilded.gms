<?php
namespace gms\system\menu\character\profile\content;
use gms\data\character\activity\CharacterActivityList;
use gms\data\character\Character;
use wcf\system\SingletonFactory;
use wcf\system\WCF;

class ActivityCharacterProfileMenuContent extends SingletonFactory implements ICharacterProfileMenuContent {
	protected $activityList = null;

	/**
	 * @see	\wcf\system\SingletonFactory::init()
	 */
	protected function init() {
		$this->activityList = new CharacterActivityList();
	}

	/**
	 * @see	\wcf\system\menu\character\profile\content\ICharacterProfileMenuContent::getNumberOfItems()
	 */
	public function getNumberOfItems(Character $character) {
		$this->activityList->getConditionBuilder()->add('characterID = ?', array($character->characterID));

		return $this->activityList->countObjects();
	}

	/**
	 * @see	\wcf\system\menu\character\profile\content\ICharacterProfileMenuContent::isAccessible()
	 */
	public function isAccessible(Character $character) {
		return (WCF::getSession()->getPermission('user.gms.character.canViewProfile'));
	}

	/**
	 * @see	\wcf\system\menu\character\profile\content\ICharacterProfileMenuContent::getContent()
	 */
	public function getContent(Character $character) {
		$this->activityList->getConditionBuilder()->add('characterID = ?', array($character->characterID));
		$this->activityList->readObjects();
		
		WCF::getTPL()->assign(array(
			'activities' => $this->activityList,
			'characterID' => $character->characterID,
		));
		
		return WCF::getTPL()->fetch('characterProfileActivity');
	}
}
