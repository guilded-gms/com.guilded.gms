<?php
namespace gms\page;
use gms\data\guild\recruitment\application\GuildRecruitmentApplication;
use wcf\page\AbstractPage;
use wcf\system\exception\IllegalLinkException;
use wcf\system\WCF;

/**
 * Represents an guild recruitment page.
 * 
 * @author	Jeffrey Reichardt
 * @copyright	{{COPYRIGHT}}
 * @package	com.guilded.gms
 * @subpackage	page
 * @category	{{PROJECT-CATEGORY}}
 *
 * @todo	comments
 * @todo	acl check on guild
 */
class GuildRecruitmentApplicationPage extends AbstractPage {
	/**
	 * id of object
	 * @var integer
	 */
	public $objectID = 0;

	/**
	 * database object
	 * @var \gms\data\guild\recruitment\application\GuildRecruitmentApplication
	 */
	public $object = null;

	/**
	 * @see \wcf\page\IPage::readParameters()
	 */
	public function readParameters() {
		parent::readParameters();

		if (isset($_REQUEST['id'])) $this->objectID = intval($_REQUEST['id']);
		
		$this->object = new GuildRecruitmentApplication($this->objectID);
		if (!$this->object->applicationID) {
			throw new IllegalLinkException();
		}
	}

	/**
	 * @see \wcf\page\IPage::assignVariables()
	 */
	public function assignVariables() {
		parent::assignVariables();

		WCF::getTPL()->assign(array(
			'applicationID' => $this->object->getObjectID(),
			'application' => $this->object
		));
	}
}

