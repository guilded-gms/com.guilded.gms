<?php
namespace wcf\acp\form;
use wcf\data\guild\Guild;
use wcf\data\guild\GuildAction;
use wcf\data\guild\GuildEditor;
use wcf\form\AbstractForm;
use wcf\system\exception\IllegalLinkException;
use wcf\system\exception\PermissionDeniedException;
use wcf\system\WCF;
use wcf\util\StringUtil;

/**
 * Shows the guild edit form.
 */
class GuildEditForm extends GuildAddForm {
	/**
	 * @see	wcf\acp\form\GuildAddForm::$menuItemName
	 */
	public $menuItemName = 'wcf.acp.menu.link.guild.management';
	
	/**
	 * @see	wcf\page\AbstractPage::$neededPermissions
	 */
	public $neededPermissions = array('admin.guild.canEditGuild');
	
	/**
	 * guild id
	 * @var	integer
	 */
	public $guildID = 0;
	
	/**
	 * guild editor object
	 * @var	wcf\data\guild\GuildEditor
	 */
	public $guild = null;
	
	/**
	 * @see	wcf\page\IPage::readParameters()
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
		$this->name = $this->guild->name;
		$this->gameID = $this->guild->gameID;
	}
	
	/**
	 * @see	wcf\page\IPage::assignVariables()
	 */
	public function assignVariables() {
		parent::assignVariables();
		
		WCF::getTPL()->assign(array(
			'guildID' => $this->guild->guildID,
			'action' => 'edit',
			'url' => '',
			'markedGuilds' => 0,
			'guild' => $this->guild
		));
	}
	
	/**
	 * @see	wcf\form\IForm::save()
	 */
	public function save() {
		AbstractForm::save();

		// save guild
		$saveOptions = $this->optionHandler->save();
		
		$data = array(
			'data' => array_merge($this->additionalFields, array(
				'name' => $this->name,
				'gameID' => $this->gameID
			)),
			'options' => $saveOptions
		);
		$this->objectAction = new GuildAction(array($this->guildID), 'update', $data);
		$this->objectAction->executeAction();
		
		$this->saved();
		
		// reset password
		$this->name = '';
		$this->gameID = 0;
		
		// show success message
		WCF::getTPL()->assign('success', true);
	}
}
