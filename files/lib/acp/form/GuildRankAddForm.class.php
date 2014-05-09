<?php
namespace gms\acp\form;
use gms\data\guild\rank\GuildRankAction;
use gms\data\guild\Guild;
use wcf\form\AbstractForm;
use wcf\system\exception\UserInputException;
use wcf\util\StringUtil;
use wcf\system\WCF;

/**
 * Shows guild rank add form.
 * 
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	acp.form
 * @category	Guilded 2.0
 */
class GuildRankAddForm extends AbstractForm {
	/**
	 * @see	\wcf\form\AbstractForm::$action
	 */
	public $action = 'add';
	
	/**
	 * @see	\wcf\page\AbstractPage::$activeMenuItem
	 */
	public $activeMenuItem = 'gms.acp.menu.link.gms.guild.rank.add';

	/**
	 * @see	\wcf\page\AbstractPage::$neededPermissions
	 */
	public $neededPermissions = array('admin.gms.guild.canManage');
	
	/**
	 * name
	 * @var	string
	 */
	public $name = '';

	/**
	 * id of guild
	 * @var	integer
	 */
	public $guildID = 0;

	/**
	 * list of guilds, sorted by game
	 * @var	array
	 */
	public $guilds = array();
		
	/**
	 * @see	\wcf\form\Form::readFormParameters()
	 */
	public function readFormParameters() {
		parent::readFormParameters();
		
		// title
		if (isset($_POST['name'])) $this->name = StringUtil::trim($_POST['name']);
		if (isset($_POST['guildID'])) $this->guildID = intval($_POST['guildID']);
	}
	
	/**
	 * @see	\wcf\form\Form::validate()
	 */
	public function validate() {
		parent::validate();
		
		// validate empty title
		if (empty($this->name)) {
			throw new UserInputException('title');
		}
	}
	
	/**
	 * @see	\wcf\form\Form::save()
	 */
	public function save() {
		parent::save();
		
		// save data
		$this->objectAction = new GuildRankAction(array(), 'create', array('data' => array(
			'name' => $this->name,
			'guildID' => $this->guildID
		)));
		$this->objectAction->executeAction();
		
		// saved
		$this->saved();
		
		// reset values
		$this->name = '';
		$this->guildID = DEFAULT_GUILD_ID;
		
		// show success message
		WCF::getTPL()->assign('success', true);
	}

	/**
	 * @see	\wcf\page\Page::assignVariables()
	 */
	public function assignVariables() {
		parent::assignVariables();
		
		WCF::getTPL()->assign(array(
			'name' => $this->name,
			'guildID' => $this->guildID,
			'guilds' => Guild::getCategorizedGuilds()
		));
	}
}
