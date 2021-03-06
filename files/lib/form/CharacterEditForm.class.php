<?php
namespace gms\form;
use gms\data\character\Character;
use gms\data\character\CharacterAction;
use gms\data\character\CharacterEditor;
use gms\system\character\activity\CharacterActivityHandler;
use wcf\form\AbstractForm;
use wcf\system\exception\IllegalLinkException;
use wcf\system\WCF;

/**
 * Shows the character edit form.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	form
 * @category	Guilded 2.0
 *
 * @todo set edit values
 */
class CharacterEditForm extends CharacterAddForm {
	/**
	 * @see	\wcf\form\AbstractForm::$action
	 */
	public $action = 'edit';

	/**
	 * @see	\wcf\page\AbstractPage::$neededPermissions
	 */
	public $neededPermissions = array('user.gms.character.canManage');
	
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
	 * @see	\wcf\page\IPage::readParameters()
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
	 * @see	\wcf\page\IPage::readData()
	 */
	public function readData() {
		parent::readData();

		if (!count($_POST)) {
			$this->characterName = $this->character->name;
			$options = $this->optionHandler->getCategoryOptions();
			
			foreach ($options as $option) {
				$value = $this->character->{$option['object']->optionName};
				if ($value !== null) {
					$this->optionValues[$option['object']->optionName] = $value;
				}
			}
		}
	}
	
	/**
	 * @see	\wcf\page\IPage::assignVariables()
	 */
	public function assignVariables() {
		parent::assignVariables();

		WCF::getTPL()->assign(array(
			'characterID' => $this->character->characterID
		));
	}
	
	/**
	 * @see	\wcf\form\IForm::save()
	 */
	public function save() {
		AbstractForm::save();
		
		// save character
		$optionValues = $this->optionHandler->save();

		$this->objectAction = new CharacterAction(array($this->characterID), 'update', array(
			'data' => array_merge($this->additionalFields, array(
				'characterName' => $this->characterName
			)),
			'options' => $optionValues
		));
		$returnValues = $this->objectAction->executeAction();

		// refresh character
		$this->character = new CharacterEditor(new Character($returnValues['objectIDs'][0]));

		// fire activity maxLevel
		// @todo do this in CharacterAction
		if ($this->character->getDecoratedObject()->getGame()->maxLevel == $this->character->level) {
			CharacterActivityHandler::getInstance()->fireEvent('reached.maximumLevel', $this->character, $this->character->getDecoratedObject()->getGame());
		}

		$this->saved();
		
		// show success message
		WCF::getTPL()->assign('success', true);
	}
}
