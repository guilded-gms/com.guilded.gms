<?php
namespace gms\page;
use gms\data\character\CharacterProfile;
use gms\system\menu\character\profile\CharacterProfileMenu;
use wcf\page\AbstractPage;
use wcf\system\breadcrumb\Breadcrumb;
use wcf\system\request\LinkHandler;
use wcf\system\WCF;

/**
 * Shows the character profile page.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2013 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	page
 * @category	Guilded 2.0
 */
class CharacterPage extends AbstractPage {
	/**
	 * @see	\wcf\page\AbstractPage::$neededPermissions
	 */
	public $neededPermissions = array('user.gms.character.canViewProfile');
	
	/**
	 * character id
	 * @var	integer
	 */
	public $characterID = 0;

	/**
	 * Character object
	 * @var	\gms\data\character\CharacterProfile
	 */
	public $character = null;
	
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

		if (isset($_REQUEST['id'])) $this->characterID = intval($_REQUEST['id']);
		$this->character = CharacterProfile::getCharacterProfile($this->characterID);
		if ($this->character === null) {
			throw new IllegalLinkException();
		}
	}

	/**
	 * @see	\wcf\page\IPage::readData()
	 */
	public function readData() {
		parent::readData();

		// add breadcrumbs
		WCF::getBreadcrumbs()->add(new Breadcrumb(WCF::getLanguage()->get('gms.character.characters'), LinkHandler::getInstance()->getLink('CharacterList')));
		
		// get profile content
		$activeMenuItem = CharacterProfileMenu::getInstance()->getActiveMenuItem();
		$contentManager = $activeMenuItem->getContentManager();
		$this->profileContent = $contentManager->getContent($this->character->getDecoratedObject());
	}

	/**
	 * @see	\wcf\page\IPage::assignVariables()
	 */
	public function assignVariables() {
		parent::assignVariables();

		WCF::getTPL()->assign(array(
			'characterID' => $this->characterID,
			'character' => $this->character,
			'profileContent' => $this->profileContent,
			'characterProfileMenu' => CharacterProfileMenu::getInstance()
		));
	}	
}
