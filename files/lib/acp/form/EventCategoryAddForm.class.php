<?php
namespace gms\acp\form;
use wcf\acp\form\AbstractCategoryAddForm;

class EventCategoryAddForm extends AbstractCategoryAddForm {
	/**
	 * @see	AbstractCategoryAddForm::$activeMenuItem
	 */	
    public $activeMenuItem = 'gms.acp.menu.link.community.event.category.add';
	
	/**
	 * @see	AbstractCategoryAddForm::$objectTypeName
	 */	
    public $objectTypeName = 'com.guilded.event.category';
}
