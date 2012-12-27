<?php
namespace gms\system\dashboard\box;
use wcf\data\dashboard\box\DashboardBox;
use wcf\page\IPage;
use wcf\system\dashboard\box\AbstractDashboardBoxSidebar;
use wcf\system\WCF;

/**
 * Implementation of NewsDashboardBox. 
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2013 DevLabor UG (haftungsbeschränkt)
 * @license	CreativeCommons by-nc-sa <http://creativecommons.org/licenses/by-nc-sa/3.0/deed.de>
 * @package	com.guilded.gms
 * @subpackage	system.dashboard
 * @category	Guilded 2.0
*/
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

		return WCF::getTPL()->fetch('dashboardBoxNews', 'gms');
	}
}
