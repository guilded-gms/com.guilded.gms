<?php
namespace gms\acp\form;
use gms\data\guild\Guild;
use gms\data\guild\GuildAction;
use gms\data\guild\GuildList;
use gms\system\game\GameHandler;
use wcf\data\option\Option;
use wcf\data\option\OptionEditor;
use wcf\system\exception\UserInputException;
use wcf\system\WCF;
use wcf\system\WCFACP;

/**
 * Shows guild add form.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
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
	public $isPublic = 1;

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

		// check existing guild name
		$sql = "SELECT guildID
				FROM	".Guild::getDatabaseTableName()."
				WHERE	(name = ?) AND
						(gameID = ?)";
		$statement = WCF::getDB()->prepareStatement($sql);
		$statement->execute(array($this->name, $this->gameID));
		$row = $statement->fetchArray();

		if ($row) {
			throw new UserInputException('name', 'notUnique');
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
		$returnValues = $this->objectAction->executeAction();

		// set option DEFAULT_GUILD_ID if first guild created
		$guildList = new GuildList();
		if ($guildList->countObjects() == 1) {
			$sql = "UPDATE	wcf".WCF_N."_option
					SET		optionValue = ?
					WHERE	optionName = ?";
			$statement = WCF::getDB()->prepareStatement($sql);
			$statement->execute(array($returnValues['returnValues']->guildID, 'default_guild_id'));
		}

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
		// check master password
		WCFACP::checkMasterPassword();
		
		parent::show();
	}
}
