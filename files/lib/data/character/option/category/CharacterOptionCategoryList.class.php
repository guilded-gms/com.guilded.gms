<?php
namespace wcf\data\character\option\category;
use wcf\data\DatabaseObjectList;

/**
 * Represents an list of character option categories.
 * 
 * @author	Jeffrey Reichardt
 * @copyright	2012-2013 DevLabor UG (haftungsbeschränkt)
 * @license	CC BY-NC-SA 3.0 <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.wcf.character
 * @subpackage	data.character.option.category
 * @category	Guilded 2.0
 */
class CharacterOptionCategoryList extends DatabaseObjectList {
	/**
	 * @see	wcf\data\DatabaseObjectList::$className
	 */
	public $className = 'wcf\data\character\option\category\CharacterOptionCategory';
}
