<?php
namespace gms\data\credit;
use wcf\data\DatabaseObjectEditor;
use wcf\system\WCF;

/**
 * Editor of credits
 * 
 * @author	Jeffrey Reichardt
 * @copyright	2012-2013 DevLabor UG (haftungsbeschränkt)
 * @license	CC BY-NC-SA 3.0 <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	data.credit
 * @category	Guilded 2.0
 */
class CreditEditor extends DatabaseObjectEditor {
	/**
	 * @see	wcf\data\DatabaseObjectDecorator::$baseClass
	 */
	protected static $baseClass = 'gms\data\credit\Credit';
}
