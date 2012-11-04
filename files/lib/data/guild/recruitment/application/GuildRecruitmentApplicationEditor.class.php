<?php
namespace wcf\data\guild\recruitment\application;
use wcf\data\DatabaseObjectEditor;
use wcf\system\WCF;

class GuildRecruitmentApplicationEditor extends DatabaseObjectEditor {
	/**
	 * @see	wcf\data\DatabaseObjectDecorator::$baseClass
	 */
	protected static $baseClass = 'wcf\data\guild\recruitment\application\GuildRecruitmentApplication';
}
