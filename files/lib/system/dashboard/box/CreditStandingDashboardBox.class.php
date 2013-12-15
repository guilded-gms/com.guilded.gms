<?php
namespace gms\system\dashboard\box;
use wcf\data\credit\CreditList;
use wcf\data\dashboard\box\DashboardBox;
use wcf\page\IPage;
use wcf\system\dashboard\box\AbstractDashboardBoxSidebar;
use wcf\system\WCF;

/**
 * Dashboard box for user credit standing.
 * 
 * @author	Jeffrey Reichardt
 * @copyright	2012-2013 DevLabor UG (haftungsbeschränkt)
 * @license	CC BY-NC-SA 3.0 <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	system.dashboard.box
 * @category	Guilded 2.0
 */
class CreditStandingDashboardBox extends AbstractDashboardBoxSidebar {
	/**
	 * credit object type list
	 * @var	wcf\data\credit\Credit
	 */
	public $creditTypeList = null;
	
	/**
	 * @see	wcf\system\dashboard\box\IDashboardBox::init()
	 */
	public function init(DashboardBox $box, IPage $page) {
		parent::init($box, $page);
		
		// @todo	get only objectTypes here, getStanding
		$this->creditTypeList = new CreditList();
		$this->creditTypeList->readObjects();
	}
	
	/**
	 * @see	wcf\system\dashboard\box\AbstractDashboardBoxContent::render()
	 */
	protected function render() {
		WCF::getTPL()->assign(array(
			'creditTypeList' => $this->creditTypeList
		));
		
		return WCF::getTPL()->fetch('dashboardBoxCreditStanding');
	}
}
