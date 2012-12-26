<?php
namespace gms\system;
use wcf\system\menu\page\PageMenu;
use wcf\system\application\AbstractApplication;
use wcf\system\breadcrumb\Breadcrumb;
use wcf\system\package\PackageDependencyHandler;
use wcf\system\request\LinkHandler;
use wcf\system\WCF;

class GMSCore extends AbstractApplication {
	/**
	 * @see IApplication::__run()
	 */
	public function __run() {
		PageMenu::getInstance()->setActiveMenuItem('gms.header.menu.index');
		
		WCF::getBreadcrumbs()->add(new Breadcrumb(WCF::getLanguage()->get('gms.header.menu.index'), LinkHandler::getInstance()->getLink('Index', array('application' => 'gms'))));
	}
}
