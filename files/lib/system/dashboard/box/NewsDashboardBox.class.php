<?php
namespace gms\system\dashboard\box;
use wcf\data\dashboard\box\DashboardBox;
use wcf\page\IPage;
use wcf\system\dashboard\box\AbstractDashboardBoxSidebar;
use wcf\system\WCF;

class NewsDashboardBox extends AbstractDashboardBoxSidebar {	
	protected $newsEntriesList = null;

	/**
	 * @see	wcf\system\dashboard\box\IDashboardBox::init()
	 */
	public function init(DashboardBox $box, IPage $page) {
		parent::init($box, $page);

		// \todo init $newsEntriesList
	}
	
	/**
	 * @see	wcf\system\dashboard\box\AbstractDashboardBoxContent::render()
	 */
	protected function render() {
		WCF::getTPL()->assign(array(
			'newsEntriesList' => $this->newsEntriesList
		));

		return WCF::getTPL()->fetch('dashboardBoxNews');
	}
}
