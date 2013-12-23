<?php
namespace gms\data\guild\activity;
use wcf\data\DatabaseObjectEditor;
use wcf\system\WCF;

class GuildActivityEditor extends DatabaseObjectEditor {
	/**
	 * @see	\wcf\data\DatabaseObjectDecorator::$baseClass
	 */
	protected static $baseClass = 'gms\data\guild\activity\GuildActivity';
}
