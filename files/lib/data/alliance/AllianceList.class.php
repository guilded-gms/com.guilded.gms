<?php
namespace wcf\data\alliance;
use wcf\data\DatabaseObjectList;

/**
 * A list of Alliances
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2013 DevLabor UG (haftungsbeschränkt)
 * @license	CC BY-NC-SA 3.0 <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.wcf.character
 * @subpackage	data.alliance
 * @category	Guilded 2.0
*/
class AllianceList extends DatabaseObjectList {
	/**
	 * @see	wcf\data\DatabaseObjectList::$className
	 */
	public $className = 'wcf\data\alliance\Alliance';
}
