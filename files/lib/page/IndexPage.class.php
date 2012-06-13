<?php
namespace gms\page;
use wcf\page\AbstractPage;
use wcf\util\FileUtil;
use wcf\util\HeaderUtil;

class IndexPage extends AbstractPage {
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
