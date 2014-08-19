<?php
namespace gms\page;
use gms\data\game\instance\GameInstance;
use wcf\page\AbstractPage;
use wcf\system\exception\IllegalLinkException;
use wcf\system\WCF;

/**
 * Shows game instance page.
 * 
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @package	com.guilded.gms
 * @subpackage	page
 */
class GameInstancePage extends AbstractPage {
	/**
	 * @see	\wcf\page\AbstractPage::$neededModules
	 */
	public $neededModules = array('GMS_MODULE_INSTANCE_PROGRESS');

	/**
	 * Holds id
	 * @var integer
	 */
	public $objectID = 0;

	/**
	 * Holds object
	 * @var	\gms\data\game\instance\GameInstance
	 */
	public $object = null;

	/**
	 * @see	\wcf\page\IPage::readParameters()
	 */
	public function readParameters() {
		parent::readParameters();

		if (isset($_REQUEST['id'])) $this->objectID = intval($_REQUEST['id']);

		$this->object = new GameInstance($this->objectID);
		if (!$this->object->instanceID) {
			throw new IllegalLinkException();
		}
	}

	/**
	 * @see	\wcf\page\IPage::assignVariables()
	 */
	public function assignVariables() {
		parent::assignVariables();

		WCF::getTPL()->assign(array(
			'instanceID' => $this->object->getObjectID(),
			'instance' => $this->object
		));
	}
}
