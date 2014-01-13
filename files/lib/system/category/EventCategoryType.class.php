<?php
namespace gms\system\category;
use wcf\system\category\AbstractCategoryType;

class EventCategoryType extends AbstractCategoryType {
	/**
	 * @see	AbstractCategoryType::$aclObjectTypeName
	 */
	protected $aclObjectTypeName = 'com.guilded.gms.category';
	
	/**
	 * @see	AbstractCategoryType::$i18nLangVarCategory
	 */	
	protected $i18nLangVarCategory = 'wcf.event';
	
	/**
	 * @see	AbstractCategoryType::$langVarPrefix
	 */	
	protected $langVarPrefix = 'wcf.event.category';

	/**
	 * @see	AbstractCategoryType::$permissionPrefix
	 */	
	protected $permissionPrefix = 'admin.event.category';	
}
