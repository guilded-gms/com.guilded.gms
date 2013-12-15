<?php
namespace gms\data\alliance;
use wcf\data\DatabaseObjectList;

/**
 * A list of Alliances
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2013 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	data.alliance
 * @category	Guilded 2.0
 */
class AllianceList extends GMSDatabaseObjectList {
	/**
	 * @see	\wcf\data\DatabaseObjectList::$className
	 */
	public $className = 'wcf\data\alliance\Alliance';
}
