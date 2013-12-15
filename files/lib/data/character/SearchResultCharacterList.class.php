<?php
namespace gms\data\character;

/**
 * Represents a list of search results of characters.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2013 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	data.character
 * @category	Guilded 2.0
 */
class SearchResultCharacterList extends CharacterProfileList {
	/**
	 * @see	\wcf\data\DatabaseObjectList::$decoratorClassName
	 */
	public $decoratorClassName = 'gms\data\character\SearchResultCharacter';
}
