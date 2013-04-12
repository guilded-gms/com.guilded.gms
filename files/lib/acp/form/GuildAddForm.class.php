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
class GuildAddForm extends GuildOptionListForm {
/**
	 * @see wcf\acp\form\ACPForm::$activeMenuItem
	 */
	public $activeMenuItem = 'wcf.acp.menu.link.guild.add';
	
	/**
	 * @see wcf\page\AbstractPage::$neededPermissions
	 */
	public $neededPermissions = array('admin.guild.canAddGuild');
	
	public $name = '';
	public $gameID = 0;	
	
	public $additionalFields = array();
	
	public $games = array();
	
	/**
	 * @see wcf\form\Form::readFormParameters()
	 */
	public function readFormParameters() {
		parent::readFormParameters();
		
		if (isset($_POST['name'])) $this->name = $_POST['name'];
		if (isset($_POST['gameID'])) $this->gameID = intval($_POST['gameID']);
	}
	
	/**
	 * @see wcf\form\Form::validate()
	 */
	public function validate() {
		// validate static options
		
		if (empty($this->name)) {
			throw new UserInputException('name', 'empty');
		}
		
		// validate dynamic options
		parent::validate();
	}
	
	/**
	 * @see wcf\form\Form::save()
	 */
	public function save() {
		parent::save();
		
		// save guild
		$saveOptions = $this->optionHandler->save();
		$this->objectAction = new GuildAction(array(), 'create', array(
			'data' => array_merge($this->additionalFields, array(
				'name' => $this->name,
				'gameID' => $this->gameID
			)), 
			'options' => $saveOptions
		));
		$this->objectAction->executeAction();
		
		$this->saved();
		
		// show success message
		WCF::getTPL()->assign('success', true);
		
		//reset values
		$this->name = '';
		$this->gameID = 0;
		$this->optionHandler->resetOptionValues();
	}
	
	/**
	 * @see wcf\page\Page::readData()
	 */
	public function readData() {
		parent::readData();
		
		$this->games = GameHandler::getInstance()->getGames();
		$this->readOptionTree();
	}
	
	/**
	 * Reads option tree on page init.
	 */
	protected function readOptionTree() {
		$this->optionTree = $this->optionHandler->getOptionTree();
	}	
	
	/**
	 * @see wcf\page\Page::assignVariables()
	 */
	public function assignVariables() {
		parent::assignVariables();
		
		WCF::getTPL()->assign(array(
			'name' => $this->name,
			'gameID' => $this->gameID,
			'games' => $this->games,
			'optionTree' => $this->optionTree,
			'action' => 'add'
		));
	}
	
	/**
	 * @see wcf\page\Page::show()
	 */
	public function show() {
		// set active menu item
		ACPMenu::getInstance()->setActiveMenuItem($this->menuItemName);
		
		// check master password
		WCFACP::checkMasterPassword();
		
		parent::show();
	}
}