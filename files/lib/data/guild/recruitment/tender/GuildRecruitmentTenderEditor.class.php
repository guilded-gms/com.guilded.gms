<?php
namespace gms\data\guild\recruitment\tender;
use wcf\data\DatabaseObjectEditor;
use wcf\system\WCF;

class GuildRecruitmentTenderEditor extends GMSDatabaseObjectEditor {
	/**
	 * @see	\wcf\data\DatabaseObjectDecorator::$baseClass
	 */
	protected static $baseClass = 'gms\data\guild\recruitment\tender\GuildRecruitmentTender';
}
