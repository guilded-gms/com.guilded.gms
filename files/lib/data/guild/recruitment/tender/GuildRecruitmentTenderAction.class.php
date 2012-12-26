<?php
namespace wcf\data\guild\recruitment\tender;
use wcf\data\AbstractDatabaseObjectAction;
use wcf\system\WCF;

/**
 * Recruitment tender related actions.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2013 DevLabor UG (haftungsbeschr�nkt)
 * @license	Creative Commons <BY-NC-SA> (http://creativecommons.org/licenses/by-nc-sa/3.0/legalcode)
 * @package	com.guilded.wcf.character
 * @subpackage	data.guild.recruitment.tender
 * @category	Guilded 2.0
 */
class GuildRecruitmentTenderAction extends AbstractDatabaseObjectAction {
	/**
	 * @see	wcf\data\AbstractDatabaseObjectAction::$className
	 */
	public $className = 'wcf\data\guild\recruitment\tender\GuildRecruitmentTenderEditor';
	
	public function validateDecrease() {
		return parent::validateUpdate();
	}
	
	public function decrease() {
		// \todo update quantity
	}
}
