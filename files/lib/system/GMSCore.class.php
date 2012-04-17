<?php
namespace gms\system;
use wcf\system\menu\page\PageMenu;
use wcf\system\application\AbstractApplication;
use wcf\system\breadcrumb\Breadcrumb;
use wcf\system\package\PackageDependencyHandler;
use wcf\system\request\LinkHandler;
use wcf\system\WCF;

class GMSCore extends AbstractApplication {
	protected $packageID = 0;
	
	/**
	 * @see AbstractApplication::__construct()
	 */
	public function __construct() {
		$this->packageID = PackageDependencyHandler::getInstance()->getPackageID('com.guilded.gms');
		
		$this->initTPL();
		PageMenu::getInstance()->setActiveMenuItem('gms.header.menu.index');
		
		WCF::getBreadcrumbs()->add(new Breadcrumb(WCF::getLanguage()->get('gms.header.menu.index'), LinkHandler::getInstance()->getLink('Index', array('application' => 'gms'))));
	}
	
	/**
	 * Initializes templates
	 */
	protected function initTPL() {
		self::getTPL()->addTemplatePath($this->packageID, GMS_DIR.'templates/');
		self::getTPL()->assign('__gms', $this);
	}
}
