<?php
namespace wcf\data\character;
use wcf\data\DatabaseObjectList;

/**
 * A list of characters
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2013 DevLabor UG (haftungsbeschränkt)
 * @license	CC BY-NC-SA 3.0 <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.wcf.character
 * @subpackage	data.character
 * @category	Guilded 2.0
*/
class CharacterList extends DatabaseObjectList {
	/**
	 * @see	wcf\data\DatabaseObjectList::$className
	 */
	public $className = 'wcf\data\character\Character';	
}
