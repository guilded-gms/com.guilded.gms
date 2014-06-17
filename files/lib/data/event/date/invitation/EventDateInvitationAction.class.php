<?php
namespace gms\data\event\date\invitation;
use gms\data\event\date\participation\EventDateParticipation;
use gms\data\event\date\participation\EventDateParticipationEditor;
use wcf\data\AbstractDatabaseObjectAction;

/**
 * 
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	CC BY-NC-SA 3.0 <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	data.event.date.invitation
 * @category	Guilded 2.0
 */
class EventDateInvitationAction extends AbstractDatabaseObjectAction {
	/**
	 * @see	\wcf\data\AbstractDatabaseObjectAction::$className
	 */
	public $className = 'gms\data\event\date\invitation\EventDateInvitationEditor';
	
	/**
	 * @see	\wcf\data\AbstractDatabaseObjectAction::$permissionsCreate
	 */
	protected $permissionsCreate = array('mod.gms.event.invitation.canManage');
	
	/**
	 * @see	\wcf\data\AbstractDatabaseObjectAction::$permissionsDelete
	 */
	protected $permissionsDelete = array('mod.gms.event.invitation.canManage');
	
	/**
	 * @see	\wcf\data\AbstractDatabaseObjectAction::$permissionsUpdate
	 */
	protected $permissionsUpdate = array('mod.gms.event.invitation.canManage');

	/**
	 * @see	\wcf\data\AbstractDatabaseObjectAction::create()
	 */
	public function create() {
		$participation = EventDateParticipationEditor::create(array(
			'time' => TIME_NOW,
			'userID' => $this->parameters['data']['userID'],
			'characterID' => $this->parameters['data']['characterID'],
			'statusTime' => TIME_NOW,
			'status' => EventDateParticipation::STATUS_MAYBE
		));

		$this->parameters['data']['participationID'] = $participation->participationID;

		return parent::create();
	}

	/**
	 * @see	\wcf\data\AbstractDatabaseObjectAction::delete()
	 */
	public function delete() {
		if (empty($this->objects)) {
			$this->readObjects();
		}

		foreach ($this->objects as $objectEditor) {
			$participationEditor = new EventDateParticipationEditor($objectEditor->getParticipation());
			$participationEditor->delete();
		}

		return parent::delete();
	}

	/**
	 * Validates confirmation.
	 */
	public function validateConfirm() {
		parent::validateDelete();
	}

	/**
	 * Confirm invitation.
	 */
	public function confirm() {
		if (empty($this->objects)) {
			$this->readObjects();
		}

		foreach ($this->objects as $objectEditor) {
			$participationEditor = new EventDateParticipationEditor($objectEditor->getParticipation());
			$participationEditor->update(array(
				'statusTime' => TIME_NOW,
				'status' => EventDateParticipation::STATUS_YES
			));

			$objectEditor->delete();
		}
	}

	/**
	 * Validates invitation.
	 */
	public function validateDecline() {
		parent::validateDelete();
	}

	/**
	 * Declines invitation.
	 */
	public function decline() {
		if (empty($this->objects)) {
			$this->readObjects();
		}

		foreach ($this->objects as $objectEditor) {
			$participationEditor = new EventDateParticipationEditor($objectEditor->getParticipation());
			$participationEditor->update(array(
				'statusTime' => TIME_NOW,
				'status' => EventDateParticipation::STATUS_NO
			));

			$objectEditor->delete();
		}
	}
}
