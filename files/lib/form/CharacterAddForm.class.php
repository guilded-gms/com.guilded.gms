<?php
namespace wcf\form;
use wcf\acp\form\AbstractOptionListForm;
use wcf\data\character\Character;
use wcf\data\character\CharacterAction;
use wcf\data\character\CharacterEditor;
use wcf\system\exception\SystemException;
use wcf\system\exception\UserInputException;
use wcf\system\WCF;
use wcf\util\ClassUtil;
use wcf\util\StringUtil;

/**
 * Shows the character add form.
  */
class CharacterAddForm extends AbstractOptionListForm {
	/**
	 * @see wcf\page\AbstractPage::$neededPermissions
	 */
	public $neededPermissions = array('user.character.canAddCharacter');
	
	/**
	 * @see wcf\page\AbstractPage::$templateName
	 */
	public $templateName = 'characterAdd';
	
	/**
	 * @see wcf\acp\form\AbstractOptionListForm::$cacheName
	 */
	public $cacheName = 'character-option';
	
	/**
	 * active tab menu item name
	 * @var string
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
	 * @see	wcf\acp\form\AbstractOptionListForm::$optionHandlerClassName
	 */
	public $optionHandlerClassName = 'wcf\system\option\character\CharacterOptionHandler';
	
	/**
	 * @see	wcf\acp\form\AbstractOptionListForm::$supportI18n
	 */
	public $supportI18n = false;
	
	/**
	 * character name
	 * @var string
	 */
	public $characterName = '';
	
	/**
	 * additional fields
	 * @var array
	 */
	public $additionalFields = array();
	
	/**
	 * @see wcf\form\IForm::readFormParameters()
	 */
	public function readFormParameters() {
		parent::readFormParameters();

		if (isset($_POST['characterName'])) $this->characterName = StringUtil::trim($_POST['characterName']);
		if (isset($_POST['activeTabMenuItem'])) $this->activeTabMenuItem = $_POST['activeTabMenuItem'];
		if (isset($_POST['activeMenuItem'])) $this->activeMenuItem = $_POST['activeMenuItem'];
	}
	
	/**
	 * @see wcf\form\IForm::validate()
	 */
	public function validate() {
		// validate dynamic options
		parent::validate();
		
		// validate character name
		if (empty($this->characterName)) {
			throw new UserInputException('characterName', 'empty');
		}		
		
		// \todo validate character name exists for game
	}
	
	/**
	 * @see wcf\form\IForm::save()
	 */
	public function save() {
		parent::save();
		
		//set up default values
		$optionValues = $this->optionHandler->save();
		
		$data = array(
			'data' => array_merge($this->additionalFields, array('characterName' => $this->characterName)),
			'options' => $optionValues
		);
		$this->objectAction = new CharacterAction(array(), 'create', $data);
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
	 * @see wcf\page\IPage::readData()
	 */
	public function readData() {
		parent::readData();
		
		$this->optionTree = $this->optionHandler->getOptionTree();
		if (!count($_POST)) {
			$this->activeTabMenuItem = $this->optionTree[0]['object']->categoryName;
		}
	}
	
	/**
	 * @see wcf\page\IPage::assignVariables()
	 */
	public function assignVariables() {
		parent::assignVariables();
		
		I18nHandler::getInstance()->assignVariables();
		
		WCF::getTPL()->assign(array(
			'characterName' => $this->characterName,
			'optionTree' => $this->optionTree,
			'action' => 'add',
			'activeTabMenuItem' => $this->activeTabMenuItem,
			'activeMenuItem' => $this->activeMenuItem
		));
	}
	
	/**
	 * @see wcf\acp\form\AbstractOptionListForm::getTypeObject()
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
