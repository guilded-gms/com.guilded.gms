<?php
namespace wcf\system\user\activity\event;
use gms\data\event\date\EventDateList;
use wcf\system\SingletonFactory;
use wcf\system\WCF;

class EventDateParticipationUserActivityEvent extends SingletonFactory implements IUserActivityEvent {
	/**
	 * @see	\wcf\system\user\activity\event\IUserActivityEvent::prepare()
	 */
	public function prepare(array $events) {
		$objectIDs = array();
		foreach ($events as $event) {
			$objectIDs[] = $event->objectID;
		}
		
		// fetch date id and title
		$eventDateList = new EventDateList();
		$eventDateList->getConditionBuilder()->add("event_date.dateID IN (?)", array($objectIDs));
		$eventDateList->readObjects();
		$eventDates = $eventDateList->getObjects();
		
		// set message
		foreach ($events as $event) {
			if (isset($eventDates[$event->objectID])) {
				// validate permissions
				if (!WCF::getSession()->getPermission('user.gms.event.canView')) {
					continue;
				}

				$event->setIsAccessible();

				$text = WCF::getLanguage()->getDynamicVariable('gms.user.event.date.recentActivity.participation', array('eventDate' => $eventDates[$event->objectID]));
				$event->setTitle($text);
				$event->setDescription(WCF::getTPL()->fetch('__userActivityEventDateParticipation', 'gms', array(
					'eventDate' => $eventDates[$event->objectID]
				)));
			}
			else {
				$event->setIsOrphaned();
			}
		}
	}
}
