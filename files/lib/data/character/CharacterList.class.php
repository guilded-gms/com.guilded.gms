<?php
namespace gms\data\character;
use wcf\data\DatabaseObjectList;

/**
 * A list of characters
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2013 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	data.character
 * @category	Guilded 2.0
 */
class CharacterList extends DatabaseObjectList {
	/**
	 * @see	\wcf\data\DatabaseObjectList::$className
	 */
	public $className = 'gms\data\character\Character';
}
