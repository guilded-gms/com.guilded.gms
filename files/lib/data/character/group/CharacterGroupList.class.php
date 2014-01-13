<?php
namespace gms\data\character\group;
use wcf\data\DatabaseObjectList;

/**
 * Represents a list of groups.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	data.character.group
 * @category	Guilded 2.0
 */
class CharacterGroupList extends DatabaseObjectList {
	/**
	 * @see	\wcf\data\DatabaseObjectList::$className
	 */
	public $className = 'gms\data\character\group\CharacterGroup';
}
