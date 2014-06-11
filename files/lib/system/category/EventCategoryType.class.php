<?php
namespace gms\system\category;
use wcf\system\category\AbstractCategoryType;
use wcf\system\WCF;

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

	/**
	 * @see	\wcf\system\category\ICategoryType::canAddCategory()
	 */
	public function canAddCategory() {
		return WCF::getSession()->getPermission('admin.gms.event.canManage');
	}

	/**
	 * @see	\wcf\system\category\ICategoryType::canDeleteCategory()
	 */
	public function canDeleteCategory() {
		return WCF::getSession()->getPermission('admin.gms.event.canManage');
	}

	/**
	 * @see	\wcf\system\category\ICategoryType::canEditCategory()
	 */
	public function canEditCategory() {
		return WCF::getSession()->getPermission('admin.gms.event.canManage');
	}
}
