<?php
namespace gms\data\character;

/**
 * Represents a list of character profiles.
 */
class CharacterProfileList extends CharacterList {
	/**
	 * @see	\wcf\data\DatabaseObjectList::$sqlOrderBy
	 */
	public $sqlOrderBy = 'character_table.name';
	
	/**
	 * decorator class name
	 * @var string
	 */
	public $decoratorClassName = 'gms\data\character\CharacterProfile';
}
