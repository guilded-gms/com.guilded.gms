<?php
namespace gms\system;
use wcf\system\menu\page\PageMenu;
use wcf\system\application\AbstractApplication;
use wcf\system\breadcrumb\Breadcrumb;
use wcf\system\request\LinkHandler;
use wcf\system\WCF;

/**
 * Implementation of Guilded application.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2013 DevLabor UG (haftungsbeschränkt)
 * @license	CC BY-NC-SA 3.0 <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	system
 * @category	Guilded 2.0
*/
class GMSCore extends AbstractApplication {
	/**
	 * @see AbstractApplication::$abbreviation
	 */
	protected $abbreviation = 'gms';

	/**
	 * @see IApplication::__run()
	 */
	public function __run() {
		if(!$this->isActiveApplication()) {
			return;
		}
		
		// activate pageMenu item
		PageMenu::getInstance()->setActiveMenuItem($this->abbreviation.'.header.menu.index');
			
		// add breadcrumb
		WCF::getBreadcrumbs()->add(new Breadcrumb(WCF::getLanguage()->get($this->abbreviation.'.header.menu.index'), LinkHandler::getInstance()->getLink('Index', array('application' => $this->abbreviation))));
	}
}
