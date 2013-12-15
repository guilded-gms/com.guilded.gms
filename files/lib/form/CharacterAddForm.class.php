<?php
namespace gms\form;
use wcf\acp\form\AbstractOptionListForm;
use gms\data\character\CharacterAction;
use wcf\system\breadcrumb\Breadcrumb;
use wcf\system\breadcrumb\Breadcrumbs;
use wcf\system\exception\SystemException;
use wcf\system\exception\UserInputException;
use wcf\system\game\GameHandler;
use wcf\system\request\LinkHandler;
use wcf\system\WCF;
use wcf\util\ClassUtil;
use wcf\util\StringUtil;

/**
 * Shows the character add form.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2013 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	form
 * @category	Guilded 2.0
 */
class CharacterAddForm extends AbstractOptionListForm {
	/**
	 * @see	\wcf\form\AbstractForm::$action
	 */
	public $action = 'add';

	/**
	 * @see	\wcf\page\AbstractPage::$neededPermissions
	 */
	public $neededPermissions = array('user.character.canManageCharacter');
	
	/**
	 * @see	\wcf\page\AbstractPage::$templateName
	 */
	public $templateName = 'characterAdd';
	
	/**
	 * @see	\wcf\acp\form\AbstractOptionListForm::$cacheName
	 */
	public $cacheName = 'character-option';
	
	/**
	 * active tab menu item name
	 * @var	string
	 */
	public $activeTabMenuItem = '';
	
	/**
	 * active sub tab menu item name
	 * @var string
	 */
	public $activeMenuItem = '';
	
	/**
	 * the option tree
	 * @var array
	 */
	public $optionTree = array();
	
	/**
	 * @see	\wcf\acp\form\AbstractOptionListForm::$optionHandlerClassName
	 */
	public $optionHandlerClassName = 'wcf\system\option\character\CharacterOptionHandler';
	
	/**
	 * @see	\wcf\acp\form\AbstractOptionListForm::$supportI18n
	 */
	public $supportI18n = false;
	
	/**
	 * character name
	 * @var string
	 */
	public $characterName = '';

	/**
	 * id of selected game
	 * @var int
	 */
	public $gameID = 0;
	
	/**
	 * additional fields
	 * @var array
	 */
	public $additionalFields = array();
	
	/**
	 * @see	\wcf\form\IForm::readFormParameters()
	 */
	public function readFormParameters() {
		parent::readFormParameters();

		if (isset($_POST['characterName'])) $this->characterName = StringUtil::trim($_POST['characterName']);
		if (isset($_POST['gameID'])) $this->gameID = intval($_POST['gameID']);

		if (isset($_POST['activeTabMenuItem'])) $this->activeTabMenuItem = $_POST['activeTabMenuItem'];
		if (isset($_POST['activeMenuItem'])) $this->activeMenuItem = $_POST['activeMenuItem'];
	}
	
	/**
	 * @see	\wcf\form\IForm::validate()
	 */
	public function validate() {
		// validate dynamic options
		parent::validate();
		
		// validate character name
		if (empty($this->characterName)) {
			throw new UserInputException('characterName', 'empty');
		}		
		
		// validate existing character name for game
		$sql = "SELECT
					COUNT(*) AS count
				FROM wcf".WCF_N."_character character_table
				WHERE 	(character_table.name = ?) AND
						(character_table.gameID = ?)";
		$statement = WCF::getDB()->prepareStatement($sql);
		$statement->execute(array($this->characterName, $this->gameID));
		$row = $statement->fetchArray();

		if ($row['count'] > 0) {
			throw new UserInputException('characterName', 'taken');
		}
	}
	
	/**
	 * @see	\wcf\form\IForm::save()
	 */
	public function save() {
		parent::save();
		
		//set up default values
		$optionValues = $this->optionHandler->save();

		$this->objectAction = new CharacterAction(array(), 'create', array(
			'data' => array_merge($this->additionalFields, array(
				'name' => $this->characterName,
				'gameID' => $this->gameID,
				'userID' => WCF::getUser()->userID
			)),
			'options' => $optionValues
		));
		$this->objectAction->executeAction();
		
		$this->saved();
		
		// show success message
		WCF::getTPL()->assign(array(
			'success' => true
		));
		
		// reset values
		$this->characterName = '';
		$this->optionValues = array();
	}
	
	/**
	 * @see	\wcf\page\IPage::readData()
	 */
	public function readData() {
		parent::readData();

		// add breadcrumbs
		Breadcrumbs::getInstance()->add(new Breadcrumb(WCF::getLanguage()->get('wcf.user.menu.profile.character'), LinkHandler::getInstance()->getLink('CharacterManagement')));

		$this->optionHandler->setGame(GameHandler::getInstance()->getGame());
		$this->optionTree = $this->optionHandler->getOptionTree();

		if (!count($_POST) && count($this->optionTree)) {
			$this->activeTabMenuItem = $this->optionTree[0]['object']->categoryName;
		}
	}
	
	/**
	 * @see	\wcf\page\IPage::assignVariables()
	 */
	public function assignVariables() {
		parent::assignVariables();

		WCF::getTPL()->assign(array(
			'characterName' => $this->characterName,
			'optionTree' => $this->optionTree,
			'activeTabMenuItem' => $this->activeTabMenuItem,
			'activeMenuItem' => $this->activeMenuItem,
			'availableGames' => GameHandler::getInstance()->getGames(),
			'gameID' => DEFAULT_GAME_ID
		));
	}
	
	/**
	 * @see	\wcf\acp\form\AbstractOptionListForm::getTypeObject()
	 */
	protected function getTypeObject($type) {
		if (!isset($this->typeObjects[$type])) {
			$className = 'wcf\system\option\character\\'.StringUtil::firstCharToUpperCase($type).'CharacterOptionType';
			
			// create instance
			if (!class_exists($className)) {
				throw new SystemException("unable to find class '".$className."'");
			}
			if (!ClassUtil::isInstanceOf($className, 'wcf\system\option\character\ICharacterOptionType')) {
				throw new SystemException("'".$className."' should implement wcf\system\option\character\ICharacterOptionType");
			}
			$this->typeObjects[$type] = new $className();
		}
		
		return $this->typeObjects[$type];
	}
}
