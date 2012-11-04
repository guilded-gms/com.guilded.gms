<?php
namespace wcf\data\guild\recruitment\tender;
use wcf\data\AbstractDatabaseObjectAction;
use wcf\system\database\util\PreparedStatementConditionBuilder;
use wcf\system\exception\PermissionDeniedException;
use wcf\system\exception\ValidateActionException;
use wcf\system\WCF;
use wcf\util\StringUtil;

/**
 * Recruitment tender related actions.
 *
 * @author 		Jeffrey Reichardt
 * @copyright	2012-2013 DevLabor Unternehmergesellschaft (haftungsbeschr�nkt)
 * @license		Creative Commons <BY-NC-SA> (http://creativecommons.org/licenses/by-nc-sa/3.0/legalcode)
 * @package		com.guilded.wcf.character
 * @subpackage	data.guild.recruitment.tender
 * @category 	Guilded
 */
class GuildRecruitmentTenderAction extends AbstractDatabaseObjectAction {
	/**
	 * @see	wcf\data\AbstractDatabaseObjectAction::$className
	 */
	public $className = 'wcf\data\guild\recruitment\tender\GuildRecruitmentTenderEditor';
}
