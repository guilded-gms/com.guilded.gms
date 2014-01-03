<?php
namespace gms\data\guild\recruitment\tender;
use wcf\data\AbstractDatabaseObjectAction;
use wcf\system\WCF;

/**
 * Recruitment tender related actions.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons <BY-NC-SA> (http://creativecommons.org/licenses/by-nc-sa/3.0/legalcode)
 * @package	com.guilded.gms
 * @subpackage	data.guild.recruitment.tender
 * @category	Guilded 2.0
 */
class GuildRecruitmentTenderAction extends AbstractDatabaseObjectAction {
	/**
	 * @see	\wcf\data\AbstractDatabaseObjectAction::$className
	 */
	public $className = 'gms\data\guild\recruitment\tender\GuildRecruitmentTenderEditor';

	/**
	 * @see	\wcf\data\AbstractDatabaseObjectAction::$permissionsCreate
	 */
	protected $permissionsCreate = array('admin.guild.canManageGuild');

	/**
	 * @see	\wcf\data\AbstractDatabaseObjectAction::$permissionsDelete
	 */
	protected $permissionsDelete = array('admin.guild.canManageGuild');

	/**
	 * @see	\wcf\data\AbstractDatabaseObjectAction::$permissionsUpdate
	 */
	protected $permissionsUpdate = array('admin.guild.canManageGuild');

	/**
	 * Validates decreasing of job positions.
	 */
	public function validateDecrease() {
		return parent::validateUpdate();
	}

	/**
	 * Decrease open job positions.
	 */
	public function decrease() {
		if (empty($this->objects)) {
			$this->readObjects();
		}

		foreach ($this->objects as $tenderEditor) {
			$tenderEditor->update(array('quantity' => $tenderEditor->quantity - 1));
		}
	}
}
