<?php
namespace gms\system\category;
use wcf\system\category\AbstractCategoryType;

class EventCategoryType extends AbstractCategoryType {
	/**
	 * @see	\wcf\system\category\AbstractCategoryType::$aclObjectTypeName
	 */
	protected $aclObjectTypeName = 'com.guilded.gms.event.category';
	
	/**
	 * @see	\wcf\system\category\AbstractCategoryType::$i18nLangVarCategory
	 */	
	protected $i18nLangVarCategory = 'gms.event';
	
	/**
	 * @see	\wcf\system\category\AbstractCategoryType::$langVarPrefix
	 */	
	protected $langVarPrefix = 'gms.event.category';

	/**
	 * @see	\wcf\system\category\AbstractCategoryType::$permissionPrefix
	 */	
	protected $permissionPrefix = 'admin.gms.event';

	/**
	 * @see	\wcf\system\category\ICategoryType::getApplication();
	 */
	public function getApplication() {
		return 'gms';
	}
}
