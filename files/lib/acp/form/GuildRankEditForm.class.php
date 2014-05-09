<?php
namespace gms\acp\form;
use gms\data\guild\rank\GuildRank;
use gms\data\guild\rank\GuildRankAction;
use wcf\form\AbstractForm;
use wcf\system\WCF;

/**
 * Shows guild rank edit form.
 * 
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	acp.form
 * @category	Guilded 2.0
 */
class GuildRankEditForm extends GuildRankAddForm {
	/**
	 * @see	\wcf\form\AbstractForm::$action
	 */
	public $action = 'edit';
	
	/**
	 * @see	\wcf\page\AbstractPage::$activeMenuItem
	 */
	public $activeMenuItem = 'wcf.acp.menu.link.gms.guild.rank';

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
		
		$this->object = new GuildRank($this->objectID);
		if (!$this->object->rankID) {
			throw new IllegalLinkException();
		}
	}

	/**
	 * @see Page::readData()
	 */
	public function readData() {
		parent::readData();

		if (!count($_POST)) {
			$this->name = $this->object->name;
			$this->guildID = $this->object->guildID;
		}
	}

	/**
	 * @see Form::save()
	 */
	public function save() {
		AbstractForm::save();

		// update label
		$this->objectAction = new GuildRankAction(array($this->objectID), 'update', array('data' => array(
			'name' => $this->name,
			'guildID' => $this->guildID
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
			'rankID' => $this->objectID,
			'rank' => $this->object
		));
	}
}
