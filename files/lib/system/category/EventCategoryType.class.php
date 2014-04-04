<?php
namespace gms\system\category;
use wcf\system\category\AbstractCategoryType;

class EventCategoryType extends AbstractCategoryType {
	/**
	 * @see	AbstractCategoryType::$aclObjectTypeName
	 */
	protected $aclObjectTypeName = 'com.guilded.gms.event.category';
	
	/**
	 * @see	AbstractCategoryType::$i18nLangVarCategory
	 */	
	protected $i18nLangVarCategory = 'gms.event';
	
	/**
	 * @see	AbstractCategoryType::$langVarPrefix
	 */	
	protected $langVarPrefix = 'gms.event.category';

	/**
	 * @see	AbstractCategoryType::$permissionPrefix
	 */	
	protected $permissionPrefix = 'admin.gms.event';
}
