<?php
namespace gms\acp\form;
use gms\data\guild\GuildAction;
use gms\system\game\GameHandler;
use wcf\system\menu\acp\ACPMenu;
use wcf\system\WCF;
use wcf\system\WCFACP;

/**
 * Shows guild add form.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2013 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	acp.form
 * @category	Guilded 2.0
 */
class GuildAddForm extends GuildOptionListForm {
	/**
	 * @see	\wcf\page\AbstractPage::$action
	 */
	public $action = 'add';

	/**
	 * @see	\wcf\page\AbstractPage::$activeMenuItem
	 */
	public $activeMenuItem = 'gms.acp.menu.link.gms.guild.add';
	
	/**
	 * @see	\wcf\page\AbstractPage::$neededPermissions
	 */
	public $neededPermissions = array('admin.gms.guild.canManage');

	/**
	 * id of game
	 * @var	int
	 */
	public $gameID = 0;

	/**
	 * guild name
	 * @var	string
	 */
	public $name = '';

	/**
	 * guild shown in public area
	 * @var    integer
	 */
	public $isPublic = 0;

	/**
	 * additional data for insert and edit
	 * @var	array
	 */
	public $additionalFields = array();

	/**
	 * @see	\wcf\form\Form::readFormParameters()
	 */
	public function readFormParameters() {
		parent::readFormParameters();
		
		if (isset($_POST['name'])) $this->name = $_POST['name'];
		if (isset($_POST['gameID'])) $this->gameID = intval($_POST['gameID']);
		if (isset($_POST['isPublic'])) $this->isPublic = intval($_POST['isPublic']);
	}
	
	/**
	 * @see	\wcf\form\Form::validate()
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
	 * @see	\wcf\form\Form::save()
	 */
	public function save() {
		parent::save();
		
		// save guild
		$savedOptions = $this->optionHandler->save();

		$this->objectAction = new GuildAction(array(), 'create', array(
			'data' => array_merge($this->additionalFields, array(
				'name' => $this->name,
				'gameID' => $this->gameID,
				'isPublic' => $this->isPublic
			)), 
			'options' => $savedOptions
		));
		$this->objectAction->executeAction();
		
		$this->saved();
		
		// show success message
		WCF::getTPL()->assign('success', true);
		
		//reset values
		$this->name = '';
		$this->gameID = 0;
		$this->isPublic = 0;
	}
	
	/**
	 * @see	\wcf\page\Page::readData()
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
	 * @see	\wcf\page\Page::assignVariables()
	 */
	public function assignVariables() {
		parent::assignVariables();

		WCF::getTPL()->assign(array(
			'name' => $this->name,
			'gameID' => $this->gameID,
			'isPublic' => $this->isPublic,
			'optionTree' => $this->optionTree,
			'availableGames' => $this->games
		));
	}
	
	/**
	 * @see	\wcf\page\Page::show()
	 */
	public function show() {
		// set active menu item
		ACPMenu::getInstance()->setActiveMenuItem($this->activeMenuItem); //$this->menuItemName);
		
		// check master password
		WCFACP::checkMasterPassword();
		
		parent::show();
	}
}
