<?php
namespace wcf\acp\form;
use wcf\data\guild\GuildAction;

/**
 * Shows guild add form.
 *
 * @author 		Jeffrey Reichardt
 * @copyright	2012-2013 DevLabor Unternehmergesellschaft (haftungsbeschränkt)
 * @license		Creative Commons <BY-NC-SA> (http://creativecommons.org/licenses/by-nc-sa/3.0/legalcode)
 * @package     com.guilded.wcf.character
 * @subpackage	acp.form
 * @category 	Guilded
 */
class GuildAddForm extends ACPForm {
/**
	 * @see wcf\acp\form\ACPForm::$activeMenuItem
	 */
	public $activeMenuItem = 'wcf.acp.menu.link.guild.add';
	
	/**
	 * @see wcf\page\AbstractPage::$neededPermissions
	 */
	//public $neededPermissions = array('admin.guild.canAddGuild'); // \todo
	
	public $name = '';
	public $server = '';
	public $gameID = 0;	
	public $additionalFields = array();
	
	public $games = array();
	
	/**
	 * @see wcf\form\Form::readFormParameters()
	 */
	public function readFormParameters() {
		parent::readFormParameters();
		
		if (isset($_POST['name'])) $this->name = $_POST['name'];
		if (isset($_POST['server'])) $this->server = $_POST['server'];
		if (isset($_POST['gameID'])) $this->gameID = intval($_POST['gameID']);
	}
	
	/**
	 * @see wcf\form\Form::validate()
	 */
	public function validate() {
		parent::validate();
		
		if (empty($this->name)) {
			throw new UserInputException('name', 'empty');
		}
	}
	
	/**
	 * @see wcf\form\Form::save()
	 */
	public function save() {
		parent::save();
		
		// save guild
		$this->objectAction = new GuildAction(array(), 'create', array('data' => array(
			'guildName' => $this->name,
			'gameID' => $this->gameID,
			'server' => $this->server
		)));
		// \todo additionalFields
		$this->objectAction->executeAction();
		
		$this->saved();
		
		// reset
		$this->name = $this->server = '';
		$this->gameID = 0;
		
		// show success message
		WCF::getTPL()->assign('success', true);
	}
	
	/**
	 * @see wcf\page\Page::readData()
	 */
	public function readData() {
		parent::readData();
		
		$this->games = GameHandler::getInstance()->getGames();
	}
	
	/**
	 * @see wcf\page\Page::assignVariables()
	 */
	public function assignVariables() {
		parent::assignVariables();
		
		WCF::getTPL()->assign(array(
			'name' => $this->name,
			'gameID' => $this->gameID,
			'server' => $this->server,
			'games' => $this->games
		));
	}
	
	/**
	 * @see wcf\page\Page::show()
	 */
	public function show() {
		// check master password
		WCFACP::checkMasterPassword();
		
		parent::show();
	}
}