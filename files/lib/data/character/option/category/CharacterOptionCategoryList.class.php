<?php
namespace gms\data\character\option\category;
use wcf\data\DatabaseObjectList;

/**
 * Represents an list of character option categories.
 * 
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	data.character.option.category
 * @category	Guilded 2.0
 */
class CharacterOptionCategoryList extends DatabaseObjectList {
	/**
	 * @see	\wcf\data\DatabaseObjectList::$className
	 */
	public $className = 'gms\data\character\option\category\CharacterOptionCategory';
}
