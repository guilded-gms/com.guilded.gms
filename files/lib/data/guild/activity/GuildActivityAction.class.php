<?php
namespace gms\data\guild\activity;
use wcf\data\AbstractDatabaseObjectAction;
use wcf\system\WCF;
use wcf\util\StringUtil;

class GuildActivityAction extends AbstractDatabaseObjectAction {
	/**
	 * @see	\wcf\data\AbstractDatabaseObjectAction::$className
	 */
	public $className = 'gms\data\guild\activity\GuildActivityEditor';
}
