<?php
namespace gms\system\moderation\queue\activation;
use gms\data\event\date\participation\EventDateParticipation;
use gms\data\event\date\participation\EventDateParticipationAction;
use gms\system\moderation\queue\AbstractEventDateParticipationModerationQueueHandler;
use wcf\data\moderation\queue\ModerationQueue;
use wcf\data\moderation\queue\ViewableModerationQueue;
use wcf\system\moderation\queue\activation\IModerationQueueActivationHandler;
use wcf\system\WCF;

class EventDateParticipationModerationQueueActivationHandler extends AbstractEventDateParticipationModerationQueueHandler implements IModerationQueueActivationHandler {
	/**
	 * @see	\wcf\system\moderation\queue\AbstractModerationQueueHandler::$definitionName
	 */
	protected $definitionName = 'com.woltlab.wcf.moderation.activation';

	/**
	 * @see	\wcf\system\moderation\queue\activation\IModerationQueueActivationHandler::enableContent()
	 */
	public function enableContent(ModerationQueue $queue) {
		$participation = $this->getParticipation($queue->objectID);

		if ($this->isValid($queue->objectID) && $participation->isDisabled) {
			$objectAction = new EventDateParticipationAction(array($participation), 'enable');
			$objectAction->executeAction();
		}
	}
	
	/**
	 * @see	\wcf\system\moderation\queue\activation\IModerationQueueActivationHandler::getDisabledContent()
	 */
	public function getDisabledContent(ViewableModerationQueue $queue) {
		// init template
		WCF::getTPL()->assign(array(
			'participation' => new EventDateParticipation($queue->getAffectedObject())
		));
		
		return WCF::getTPL()->fetch('moderationEntry', 'gms');
	}
}
