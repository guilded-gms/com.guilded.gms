<?php
namespace gms\data\character\activity;
use wcf\data\AbstractDatabaseObjectAction;
use wcf\system\WCF;
use wcf\util\StringUtil;

class CharacterActivityAction extends AbstractDatabaseObjectAction {
	/**
	 * @see	\wcf\data\AbstractDatabaseObjectAction::$className
	 */
	public $className = 'gms\data\character\activity\CharacterActivityEditor';
}