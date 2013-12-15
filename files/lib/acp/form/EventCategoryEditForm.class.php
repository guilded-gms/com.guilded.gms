<?php
namespace gms\acp\form;

class EventCategoryEditForm extends AbstractCategoryEditForm {
	/**
	 * @see	AbstractCategoryAddForm::$activeMenuItem
	 */	
    public $activeMenuItem = 'wcf.acp.menu.link.community.event.category';

	/**
	 * @see	AbstractCategoryAddForm::$objectTypeName
	 */		
    public $objectTypeName = 'com.guilded.gms.event.category';
}
