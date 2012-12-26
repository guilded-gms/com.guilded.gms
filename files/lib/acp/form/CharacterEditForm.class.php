<?php
namespace wcf\acp\form;
use wcf\data\character\Character;
use wcf\data\character\CharacterAction;
use wcf\data\character\CharacterEditor;
use wcf\form\AbstractForm;
use wcf\system\exception\IllegalLinkException;
use wcf\system\exception\PermissionDeniedException;
use wcf\system\WCF;
use wcf\util\StringUtil;

/**
 * Shows the character edit form.
 */
class CharacterEditForm extends CharacterAddForm {
	/**
	 * @see	wcf\acp\form\CharacterAddForm::$menuItemName
	 */
	public $menuItemName = 'wcf.acp.menu.link.character.management';
	
	/**
	 * @see	wcf\page\AbstractPage::$neededPermissions
	 */
	public $neededPermissions = array('admin.character.canEditCharacter');
	
	/**
	 * character id
	 * @var	integer
	 */
	public $characterID = 0;
	
	/**
	 * character editor object
	 * @var	wcf\data\character\CharacterEditor
	 */
	public $character = null;
	
	/**
	 * @see	wcf\page\IPage::readParameters()
	 */
	public function readParameters() {
		if (isset($_REQUEST['id'])) $this->characterID = intval($_REQUEST['id']);
		$character = new Character($this->characterID);
		if (!$character->characterID) {
			throw new IllegalLinkException();
		}
		
		$this->character = new CharacterEditor($character);
		
		parent::readParameters();
	}
	
	/**
	 * wcf\acp\form\AbstractOptionListForm::initOptionHandler()
	 */
	protected function initOptionHandler() {
		$this->optionHandler->setCharacter($this->character->getDecoratedObject());
	}
	
	/**
	 * @see	wcf\page\IPage::readData()
	 */
	public function readData() {
		if (empty($_POST)) {
			// default values
			$this->readDefaultValues();
		}
		
		parent::readData();
	}
	
	/**
	 * Gets the default values.
	 */
	protected function readDefaultValues() {
		$this->name = $this->character->name;
		$this->gameID = $this->character->gameID;
	}
	
	/**
	 * @see	wcf\page\IPage::assignVariables()
	 */
	public function assignVariables() {
		parent::assignVariables();
		
		WCF::getTPL()->assign(array(
			'characterID' => $this->character->characterID,
			'action' => 'edit',
			'url' => '',
			'markedCharacters' => 0,
			'character' => $this->character
		));
	}
	
	/**
	 * @see	wcf\form\IForm::save()
	 */
	public function save() {
		AbstractForm::save();

		// save character
		$saveOptions = $this->optionHandler->save();
		
		$data = array(
			'data' => array_merge($this->additionalFields, array(
				'name' => $this->name,
				'gameID' => $this->gameID
			)),
			'options' => $saveOptions
		);
		$this->objectAction = new CharacterAction(array($this->characterID), 'update', $data);
		$this->objectAction->executeAction();
		
		$this->saved();
		
		// reset password
		$this->name = '';
		$this->gameID = 0;
		
		// show success message
		WCF::getTPL()->assign('success', true);
	}
}
