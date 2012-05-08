<?php
namespace wcf\form;
use wcf\data\character\Character;
use wcf\data\character\CharacterAction;
use wcf\data\character\CharacterEditor;
use wcf\form\AbstractForm;
use wcf\system\exception\IllegalLinkException;
use wcf\system\exception\PermissionDeniedException;
use wcf\system\WCF;

/**
 * Shows the character edit form.
 */
class CharacterEditForm extends CharacterAddForm {
	
	/**
	 * @see wcf\page\AbstractPage::$neededPermissions
	 */
	public $neededPermissions = array('user.character.canEditCharacter');
	
	/**
	 * character id
	 * @var integer
	 */
	public $characterID = 0;
	
	/**
	 * character editor object
	 * @var CharacterEditor
	 */
	public $character = null;
	
	/**
	 * @see wcf\page\IPage::readParameters()
	 */
	public function readParameters() {
		parent::readParameters();
		
		// get character
		if (isset($_REQUEST['id'])) $this->characterID = intval($_REQUEST['id']);
		$character = new Character($this->characterID);
		if (!$character->characterID) {
			throw new IllegalLinkException();
		}
		
		$this->character = new CharacterEditor($character);
		$this->optionHandler->setCharacter($character);
	}
	
	/**
	 * @see wcf\page\IPage::readData()
	 */
	public function readData() {
		if (!count($_POST)) {
			$this->characterName = $this->character->characterName;
			$options = $this->optionHandler->getCategoryOptions();
			
			foreach ($options as $option) {
				$value = $this->character->getOption($option['object']->optionName);
				if ($value !== null) {
					$this->optionValues[$option['object']->optionName] = $value;
				}
			}
		}
		
		parent::readData();
	}
	
	/**
	 * @see wcf\page\IPage::assignVariables()
	 */
	public function assignVariables() {
		parent::assignVariables();

		WCF::getTPL()->assign(array(
			'characterID' => $this->character->characterID,
			'action' => 'edit'
		));
	}
	
	/**
	 * @see wcf\form\IForm::save()
	 */
	public function save() {
		AbstractForm::save();
		
		// save character
		$optionValues = $this->optionHandler->save();

		$data = array(
			'data' => array_merge(array('characterName' => $this->characterName), $this->additionalFields),
			'options' => $optionValues
		);
		$this->objectAction = new CharacterAction(array($this->characterID), 'update', $data);
		$this->objectAction->executeAction();
		$this->saved();
		
		// show success message
		WCF::getTPL()->assign('success', true);
	}
}
