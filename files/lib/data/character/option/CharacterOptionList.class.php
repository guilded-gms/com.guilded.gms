<?php
namespace gms\data\character\option;
use wcf\data\DatabaseObjectList;

/**
 * Represents a list of character options.
 * 
 * @author	Jeffrey Reichardt
 * @copyright	2012-2013 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	data.character.option
 * @category	Guilded 2.0
 */
class CharacterOptionList extends DatabaseObjectList {
	/**
	 * @see	\wcf\data\DatabaseObjectList::$className
	 */
	public $className = 'gms\data\character\option\CharacterOption';
}
