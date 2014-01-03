<?php
namespace gms\acp\form;
use wcf\acp\form\AbstractCategoryAddForm;

/**
 * Shows add form for event categories.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	acp.form
 * @category	Guilded 2.0
 */
class EventCategoryAddForm extends AbstractCategoryAddForm {
	/**
	 * @see	AbstractCategoryAddForm::$activeMenuItem
	 */	
	public $activeMenuItem = 'gms.acp.menu.link.gms.event.category.add';
	
	/**
	 * @see	AbstractCategoryAddForm::$objectTypeName
	 */	
	public $objectTypeName = 'com.guilded.event.category';
}
