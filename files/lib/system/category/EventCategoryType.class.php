<?php
namespace gms\system\category;
use wcf\system\category\AbstractCategoryType;

class EventCategoryType extends AbstractCategoryType {
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
	 * @see	\wcf\system\category\AbstractCategoryType::$forceDescription
	 */
	protected $forceDescription = false;

	/**
	 * @see	\wcf\system\category\AbstractCategoryType::$maximumNestingLevel
	 */
	protected $maximumNestingLevel = 1;

	/**
	 * @see	\wcf\system\category\AbstractCategoryType::$objectTypes
	 */
	protected $objectTypes = array('com.woltlab.wcf.acl' => 'com.guilded.gms.event.category');

	/**
	 * @see	\wcf\system\category\ICategoryType::getApplication();
	 */
	public function getApplication() {
		return 'gms';
	}
}
