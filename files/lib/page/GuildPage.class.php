<?php
namespace gms\page;
use gms\data\guild\GuildProfile;
use gms\system\menu\guild\profile\GuildProfileMenu;
use wcf\page\AbstractPage;
use wcf\system\breadcrumb\Breadcrumb;
use wcf\system\dashboard\DashboardHandler;
use wcf\system\exception\IllegalLinkException;
use wcf\system\request\LinkHandler;
use wcf\system\WCF;

/**
 * Shows the guild profile page.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	page
 * @category	Guilded 2.0
 */
class GuildPage extends AbstractPage {
	/**
	 * @see	\wcf\page\AbstractPage::$neededPermissions
	 */
	public $neededPermissions = array('user.gms.guild.canViewProfile');

	/**
	 * Guild id
	 * @var integer
	 */
	public $guildID = 0;

	/**
	 * Guild object
	 * @var	\gms\data\guild\GuildProfile
	 */
	public $guild = null;

	/**
	 * profile content for active menu item
	 * @var	string
	 */
	public $profileContent = '';

	/**
	 * @see	\wcf\page\IPage::readParameters()
	 */
	public function readParameters() {
		parent::readParameters();

		if (isset($_REQUEST['id'])) {
			$this->guildID = intval($_REQUEST['id']);
		}
		else {
			$this->guildID = DEFAULT_GUILD_ID;
			if (!$this->guildID) {
				throw new IllegalLinkException();
			}
		}

		$this->guild = GuildProfile::getGuildProfile($this->guildID);
		if ($this->guild === null) {
			throw new IllegalLinkException();
		}
	}

	/**
	 * @see	\wcf\page\IPage::readData()
	 */
	public function readData() {
		parent::readData();

		// add breadcrumbs
		WCF::getBreadcrumbs()->add(new Breadcrumb(WCF::getLanguage()->get('gms.guild.guilds'), LinkHandler::getInstance()->getLink('GuildList')));

		// get profile content
		$activeMenuItem = GuildProfileMenu::getInstance()->getActiveMenuItem();
		$contentManager = $activeMenuItem->getContentManager();
		$this->profileContent = $contentManager->getContent($this->guild->getDecoratedObject());
	}

	/**
	 * @see	\wcf\page\IPage::assignVariables()
	 */
	public function assignVariables() {
		parent::assignVariables();

		DashboardHandler::getInstance()->loadBoxes('com.guilded.gms.GuildPage', $this);

		WCF::getTPL()->assign(array(
			'guildID' => $this->guildID,
			'guild' => $this->guild,
			'profileContent' => $this->profileContent,
			'guildProfileMenu' => GuildProfileMenu::getInstance()
		));
	}
}
