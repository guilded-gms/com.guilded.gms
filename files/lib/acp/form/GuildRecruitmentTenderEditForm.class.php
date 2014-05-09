<?php
namespace gms\acp\form;
use gms\data\guild\recruitment\tender\GuildRecruitmentTender;
use gms\data\guild\recruitment\tender\GuildRecruitmentTenderAction;
use wcf\form\AbstractForm;
use wcf\system\WCF;

/**
 * Shows guild tender edit form.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	acp.form
 * @category	Guilded 2.0
 */
class GuildRecruitmentTenderEditForm extends GuildRecruitmentTenderAddForm {
	/**
	 * @see	\wcf\form\AbstractForm::$action
	 */
	public $action = 'edit';
	
	/**
	 * @see	\wcf\page\AbstractPage::$activeMenuItem
	 */
	public $activeMenuItem = 'gms.acp.menu.link.gms.guild.recruitment.tender';

	/**
	 * object id
	 * @var	integer
	 */
	public $objectID = 0;

	/**
	 * Holds object
	 * @var	\wcf\data\DatabaseObject
	 */
	public $object = null;
	
	/**
	 * @see Form::readFormParameters()
	 */
	public function readParameters() {
		parent::readParameters();
			
		if (isset($_REQUEST['id'])) $this->objectID = intval($_REQUEST['id']);
		
		$this->object = new GuildRecruitmentTender($this->objectID);
		if (!$this->object->tenderID) {
			throw new IllegalLinkException();
		}
	}

	/**
	 * @see Page::readData()
	 */
	public function readData() {
		parent::readData();

		if (!count($_POST)) {
			$this->title = $this->object->title;
		}
	}

	/**
	 * @see Form::save()
	 */
	public function save() {
		AbstractForm::save();

		// update label
		$this->objectAction = new GuildRecruitmentTenderAction(array($this->objectID), 'update', array('data' => array(
			'title' => $this->title
		)));
		$this->objectAction->executeAction();

		$this->saved();

		// show success
		WCF::getTPL()->assign(array(
			'success' => true
		));
	}
	
	/**
	 * @see Form::saved()
	 */
	protected function saved() {
		AbstractForm::saved();
		
		WCF::getTpl()->assign('success', true);		
	}
	
	/**
	 * @see Page::assignVariables()
	 */
	public function assignVariables() {
		parent::assignVariables();

		WCF::getTpl()->assign(array(
			'tenderID' => $this->objectID,
			'tender' => $this->object
		));
	}
}
