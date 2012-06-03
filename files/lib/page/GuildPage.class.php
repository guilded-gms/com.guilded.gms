<?php
namespace wcf\page;
use wcf\data\guild\GuildProfile;
use wcf\system\exception\IllegalLinkException;
use wcf\system\breadcrumb\Breadcrumb;
use wcf\system\request\LinkHandler;
use wcf\system\WCF;

/**
 * Shows the guild profile page.
 *
 * @author		Jeffrey 'Kiv' Reichardt
 * @copyright	2012 Guilded.eu
 * @package    	 com.guilded.wcf.character
 * @subpackage	page
 */

class GuildPage extends AbstractPage {
	/**
	 * Guild id
	 * @var integer
	 */
	public $guildID = 0;

	/**
	 * Guild object
	 * @var wcf\data\guild\GuildProfile
	 */
	public $guild = null;

	/**
	 * @see wcf\page\IPage::readParameters()
	 */
	public function readParameters() {
		parent::readParameters();

		if (isset($_REQUEST['id'])) $this->guildID = intval($_REQUEST['id']);
		$this->guild = GuildProfile::getGuildProfile($this->guildID);
		if ($this->guild === null) {
			throw new IllegalLinkException();
		}
	}

	/**
	 * @see wcf\page\IPage::readData()
	 */
	public function readData() {
		parent::readData();

        // add breadcrumbs
		WCF::getBreadcrumbs()->add(new Breadcrumb(WCF::getLanguage()->get('wcf.character.guilds'), LinkHandler::getInstance()->getLink('GuildList')));
    }

	/**
	 * @see wcf\page\IPage::assignVariables()
	 */
	public function assignVariables() {
		parent::assignVariables();

		WCF::getTPL()->assign(array(
			'guildID' => $this->guildID,
            'guild' => $this->guild
		));
	}
}
?>
