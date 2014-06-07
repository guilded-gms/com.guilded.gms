<?php
namespace wcf\system\user\activity\event;
use gms\data\character\CharacterList;
use wcf\system\SingletonFactory;
use wcf\system\WCF;

class CharacterUserActivityEvent extends SingletonFactory implements IUserActivityEvent {
	/**
	 * @see	\wcf\system\user\activity\event\IUserActivityEvent::prepare()
	 */
	public function prepare(array $events) {
		$objectIDs = array();
		foreach ($events as $event) {
			$objectIDs[] = $event->objectID;
		}
		
		// fetch date id and title
		$characterList = new CharacterList();
		$characterList->getConditionBuilder()->add("character.characterID IN (?)", array($objectIDs));
		$characterList->readObjects();
		$characters = $characterList->getObjects();
		
		// set message
		foreach ($events as $event) {
			if (isset($characters[$event->objectID])) {
				// validate permissions
				if (!WCF::getSession()->getPermission('user.gms.character.canView')) {
					continue;
				}

				$event->setIsAccessible();

				$text = WCF::getLanguage()->getDynamicVariable('gms.user.character.recentActivity.new', array('character' => $characters[$event->objectID]));
				$event->setTitle($text);
				$event->setDescription($characters[$event->objectID]->getDescription()); // @todo show specs
			}
			else {
				$event->setIsOrphaned();
			}
		}
	}
}
