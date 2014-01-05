<?php
namespace gms\data\credit;
use wcf\data\AbstractDatabaseObjectAction;

/**
 * Handles credit-related actions
 * 
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	CC BY-NC-SA 3.0 <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	data.credit
 * @category	Guilded 2.0
 */
class CreditAction extends AbstractDatabaseObjectAction {
	/**
	 * @see	wcf\data\AbstractDatabaseObjectAction::$className
	 */
	public $className = 'gms\data\credit\CreditEditor';
}
