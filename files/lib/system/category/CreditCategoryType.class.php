<?php
namespace gms\system\category;
use wcf\system\category\AbstractCategoryType;

class CreditCategoryType extends AbstractCategoryType {
	/**
	 * @see	\wcf\system\category\AbstractCategoryType::$i18nLangVarCategory
	 */	
	protected $i18nLangVarCategory = 'gms.credit';
	
	/**
	 * @see	\wcf\system\category\AbstractCategoryType::$langVarPrefix
	 */	
	protected $langVarPrefix = 'gms.credit.category';

	/**
	 * @see	\wcf\system\category\AbstractCategoryType::$permissionPrefix
	 */	
	protected $permissionPrefix = 'admin.gms.credit';

	/**
	 * @see	\wcf\system\category\AbstractCategoryType::$objectTypes
	 */
	protected $objectTypes = array('com.woltlab.wcf.acl' => 'com.guilded.gms.credit.category');

	/**
	 * @see	\wcf\system\category\ICategoryType::getApplication();
	 */
	public function getApplication() {
		return 'gms';
	}
}
