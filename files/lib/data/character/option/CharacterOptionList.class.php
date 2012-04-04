<?php
namespace wcf\data\character\option;
use wcf\data\DatabaseObjectList;

/**
 * Represents a list of character options.
 * 
 * @author 		Jeffrey Reichardt
 * @copyright	2012 Guilded.eu
 * @license		CC by-nc-sa
 * @package	com.guilded.wcf.character
 * @subpackage	data.character.option
 * @category 	Community Framework
 */
class CharacterOptionList extends DatabaseObjectList {
	/**
	 * @see	wcf\data\DatabaseObjectList::$className
	 */
	public $className = 'wcf\data\character\option\CharacterOption';
}
