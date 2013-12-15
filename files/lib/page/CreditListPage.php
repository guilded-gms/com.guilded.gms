<?php
namespace gms\page;

/**
 * Shows the list of current credits.
 *
 * @author		Jeffrey 'Kiv' Reichardt
 * @copyright	2012 Guilded.eu
 * @package     	com.guilded.gms
 * @subpackage	page
 */
class CreditListPage extends SortablePage {
	/**
	 * @see wcf\page\AbstractPage::$neededPermissions
	 */
	public $neededPermissions = array();
	
	/**
	 * @see wcf\page\SortablePage::$defaultSortField
	 */
	public $defaultSortField = 'time';
	
	/**
	 * @see wcf\page\SortablePage::$validSortFields
	 */
	public $validSortFields = array('time');
	
	/**
	 * @see	wcf\page\MultipleLinkPage::$objectListClassName
	 */	
	public $objectListClassName = 'gms\data\credit\CreditList';
    
}
