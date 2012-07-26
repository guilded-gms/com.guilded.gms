<?php
namespace gms\system\dashboard\box;
use wcf\data\dashboard\box\DashboardBox;
use wcf\page\IPage;
use wcf\system\dashboard\box\AbstractDashboardBoxSidebar;
use wcf\system\WCF;

class NewsDashboardBox extends AbstractDashboardBoxSidebar {	
	/**
	 * @see	wcf\system\dashboard\box\IDashboardBox::init()
	 */
	public function init(DashboardBox $box, IPage $page) {
		parent::init($box, $page);
	
	}
	
	/**
	 * @see	wcf\system\dashboard\box\AbstractDashboardBoxContent::render()
	 */
	protected function render() {
		/*WCF::getTPL()->assign(array(
			'recentActivityList' => $this->recentActivityList
		));
		*/
		return WCF::getTPL()->fetch('dashboardBoxNews');
	}
}
