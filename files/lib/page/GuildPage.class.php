<?php
namespace gms\page;
use gms\data\guild\GuildProfile;
use wcf\system\breadcrumb\Breadcrumb;
use wcf\system\exception\IllegalLinkException;
use wcf\system\request\LinkHandler;
use wcf\system\WCF;

/**
 * Shows the guild profile page.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2013 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	page
 * @category	Guilded 2.0
 */
class GuildPage extends AbstractPage {
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
	}

	/**
	 * @see	\wcf\page\IPage::assignVariables()
	 */
	public function assignVariables() {
		parent::assignVariables();

		WCF::getTPL()->assign(array(
			'guildID' => $this->guildID,
			'guild' => $this->guild
		));
	}
}
