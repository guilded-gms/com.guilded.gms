<?php
namespace gms\data\credit;
use wcf\data\DatabaseObjectList;

/**
 * Represents a list of credits
 * 
 * @author	Jeffrey Reichardt
 * @copyright	2012-2013 DevLabor UG (haftungsbeschränkt)
 * @license	CC BY-NC-SA 3.0 <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	data.credit
 * @category	Guilded 2.0
 */
class CreditList extends DatabaseObjectList {
	/**
	 * @see	wcf\data\DatabaseObjectList::$className
	 */
	public $className = 'gms\data\credit\Credit';
}
