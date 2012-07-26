<?php
namespace gms\page;
use wcf\page\AbstractPage;
use wcf\util\FileUtil;
use wcf\util\HeaderUtil;

class IndexPage extends AbstractPage {
	/**
	 * @see	wcf\page\AbstractPage::assignVariables()
	 */
	public function assignVariables() {
		parent::assignVariables();
		
		DashboardHandler::getInstance()->loadBoxes('com.guilded.gms.IndexPage', $this);
	}

	/**
	 * @see IPage::show()
	 */
	public function show() {
		//redirecting to another start page
		if (FileUtil::isURL(INDEX_PAGE_REDIRECT)) {
			HeaderUtil::redirect(INDEX_PAGE_REDIRECT, false);
			exit;
		}
	
		parent::show();
	}
}
