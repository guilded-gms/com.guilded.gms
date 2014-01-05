<?php
namespace gms\acp\form;
use gms\data\character\Character;
use gms\data\character\CharacterAction;
use gms\data\character\CharacterEditor;
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
 * @subpackage	acp.form
 * @category	Guilded 2.0
 */
class CharacterEditForm extends CharacterAddForm {
	/**
	 * @see	\wcf\page\AbstractPage::$action
	 */
	public $action = 'edit';

	/**
	 * @see	\wcf\page\AbstractPage::$menuItemName
	 */
	public $menuItemName = 'gms.acp.menu.link.gms.character';
	
	/**
	 * @see	\wcf\page\AbstractPage::$neededPermissions
	 */
	public $neededPermissions = array('admin.character.canManage');
	
	/**
	 * character id
	 * @var	integer
	 */
	public $characterID = 0;
	
	/**
	 * character editor object
	 * @var	\gms\data\character\CharacterEditor
	 */
	public $character = null;
	
	/**
	 * @see	\wcf\page\IPage::readParameters()
	 */
	public function readParameters() {
		if (isset($_REQUEST['id'])) $this->characterID = intval($_REQUEST['id']);

		$character = new Character($this->characterID);
		if ($character === null) {
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
	 * @see	\wcf\page\IPage::readData()
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
	 * @see	\wcf\page\IPage::assignVariables()
	 */
	public function assignVariables() {
		parent::assignVariables();
		
		WCF::getTPL()->assign(array(
			'characterID' => $this->character->characterID,
			'character' => $this->character
		));
	}
	
	/**
	 * @see	\wcf\form\IForm::save()
	 */
	public function save() {
		AbstractForm::save();

		// save character
		$savedOptions = $this->optionHandler->save();

		$this->objectAction = new CharacterAction(array($this->characterID), 'update', array(
			'data' => array_merge($this->additionalFields, array(
				'name' => $this->name,
				'gameID' => $this->gameID
			)),
			'options' => $savedOptions
		));
		$returnValues = $this->objectAction->executeAction();
		
		$this->saved();

		// refresh character
		$this->character = $returnValues['returnValues'][0];

		// reset values
		$this->readDefaultValues();
		
		// show success message
		WCF::getTPL()->assign('success', true);
	}
}
