<?php
namespace gms\data\event;
use wcf\data\DatabaseObjectEditor;

class EventEditor extends DatabaseObjectEditor {
	/**
	 * @see	wcf\data\DatabaseObjectDecorator::$baseClass
	 */
	protected static $baseClass = 'wcf\data\event\Event';
}
