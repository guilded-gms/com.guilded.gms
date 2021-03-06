<?php
namespace gms\acp\form;
use gms\data\guild\Guild;
use gms\data\guild\recruitment\tender\GuildRecruitmentTender;
use gms\data\guild\recruitment\tender\GuildRecruitmentTenderAction;
use wcf\form\AbstractForm;
use wcf\system\exception\UserInputException;
use wcf\system\WCF;

/**
 * Form for adding guild tender.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	acp.form
 * @category	Guilded 2.0
 */
class GuildRecruitmentTenderAddForm extends AbstractForm {
	/**
	 * @see	\wcf\form\AbstractForm::$action
	 */
	public $action = 'add';
	
	/**
	 * @see	\wcf\page\AbstractPage::$activeMenuItem
	 */
	public $activeMenuItem = 'gms.acp.menu.link.gms.guild.recruitment.tender.add';

	/**
	 * @see	\wcf\page\AbstractPage::$neededPermissions
	 */
	public $neededPermissions = array('admin.gms.guild.canManage');

	/**
	 * id of guild
	 * @var	integer
	 */
	public $guildID = 0;

	/**
	 * list of guilds, sorted by game
	 * @var	array
	 */
	public $guilds = array();

	/**
	 * amount
	 * @var	integer
	 */
	public $amount = 1;

	/**
	 * priority
	 * @var	integer
	 */
	public $priority = GuildRecruitmentTender::PRIORITY_MEDIUM;

	/**
	 * @see	\wcf\form\Form::readFormParameters()
	 */
	public function readFormParameters() {
		parent::readFormParameters();
		
		// title
		if (isset($_POST['guildID'])) $this->guildID = intval($_POST['guildID']);
		if (isset($_POST['amount'])) $this->amount = intval($_POST['amount']);
		if (isset($_POST['priority'])) $this->priority = intval($_POST['priority']);
	}
	
	/**
	 * @see	\wcf\form\Form::validate()
	 */
	public function validate() {
		parent::validate();
		
		// validate empty title
		if (empty($this->title)) {
			throw new UserInputException('title');
		}
	}
	
	/**
	 * @see	\wcf\form\Form::save()
	 */
	public function save() {
		parent::save();
		
		// save data
		$this->objectAction = new GuildRecruitmentTenderAction(array(), 'create', array('data' => array(
			'guildID' => $this->guildID
		)));
		$returnValues = $this->objectAction->executeAction();
		
		// saved
		$this->saved();
		
		// reset values
		$this->guildID = 0;
		$this->amount = 1;
		$this->priority = GuildRecruitmentTender::PRIORITY_MEDIUM;

		// show success message
		WCF::getTPL()->assign('success', true);
	}

	/**
	 * @see	\wcf\page\Page::assignVariables()
	 */
	public function assignVariables() {
		parent::assignVariables();
		
		WCF::getTPL()->assign(array(
			'guildID' => $this->guildID,
			'guilds' => Guild::getCategorizedGuilds(),
			'amount' => $this->amount,
			'priority' => $this->priority
		));
	}
}
