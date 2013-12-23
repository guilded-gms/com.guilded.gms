<?php
namespace gms\acp\form;
use gms\data\guild\Guild;
use gms\data\guild\GuildAction;
use gms\data\guild\GuildEditor;
use wcf\form\AbstractForm;
use wcf\system\exception\IllegalLinkException;
use wcf\system\exception\PermissionDeniedException;
use wcf\system\WCF;
use wcf\util\StringUtil;

/**
 * Shows the guild edit form.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2013 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	acp.form
 * @category	Guilded 2.0
 */
class GuildEditForm extends GuildAddForm {
	/**
	 * @see	\wcf\page\AbstractPage::$action
	 */
	public $action = 'edit';

	/**
	 * @see	\wcf\page\AbstractPage::$menuItemName
	 */
	public $activeMenuItem = 'gms.acp.menu.link.gms.guild';

	/**
	 * guild editor object
	 * @var	\gms\data\guild\GuildEditor
	 */
	public $guild = null;
	
	/**
	 * @see	\wcf\page\IPage::readParameters()
	 */
	public function readParameters() {
		if (isset($_REQUEST['id'])) $this->guildID = intval($_REQUEST['id']);
		$guild = new Guild($this->guildID);
		if (!$guild->guildID) {
			throw new IllegalLinkException();
		}
		
		$this->guild = new GuildEditor($guild);
		
		parent::readParameters();
	}
	
	/**
	 * wcf\acp\form\AbstractOptionListForm::initOptionHandler()
	 */
	protected function initOptionHandler() {
		$this->optionHandler->setGuild($this->guild->getDecoratedObject());
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
		$this->name = $this->guild->name;
		$this->gameID = $this->guild->gameID;
		$this->isPublic = $this->guild->isPublic;
	}
	
	/**
	 * @see	\wcf\page\IPage::assignVariables()
	 */
	public function assignVariables() {
		parent::assignVariables();
		
		WCF::getTPL()->assign(array(
			'guildID' => $this->guild->guildID,
			'object' => $this->guild
		));
	}
	
	/**
	 * @see	\wcf\form\IForm::save()
	 */
	public function save() {
		AbstractForm::save();

		// save guild
		$savedOptions = $this->optionHandler->save();
		
		$data = array(
			'data' => array_merge($this->additionalFields, array(
				'name' => $this->name,
				'gameID' => $this->gameID,
				'isPublic' => $this->isPublic
			)),
			'options' => $savedOptions
		);
		$this->objectAction = new GuildAction(array($this->guildID), 'update', $data);
		$this->objectAction->executeAction();
		
		$this->saved();

		// show success message
		WCF::getTPL()->assign('success', true);

		// reset values
		$this->name = '';
		$this->gameID = 0;
		$this->isPublic = 0;
	}
}
