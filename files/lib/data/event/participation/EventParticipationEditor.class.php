<?php
namespace gms\data\event\participation;
use wcf\data\DatabaseObjectEditor;

class EventParticipationEditor extends DatabaseObjectEditor {
	/**
	 * @see	wcf\data\DatabaseObjectDecorator::$baseClass
	 */
	protected static $baseClass = 'wcf\data\event\participation\EventParticipation';
}
