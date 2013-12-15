<?php
namespace gms\page;
use wcf\page\CreditListPage;
use wcf\system\dashboard\DashboardHandler;
use wcf\system\WCF;

/**
 * Shows the credit list page.
 */
class EventCreditListPage extends CreditListPage {
	/**
	 * @see	\wcf\page\IPage::assignVariables()
	 */
	public function assignVariables() {
		parent::assignVariables();

		DashboardHandler::getInstance()->loadBoxes('com.guilded.gms.EventCreditListPage', $this);
	}
}
