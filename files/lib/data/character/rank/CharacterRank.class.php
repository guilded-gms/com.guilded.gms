<?php
namespace gms\data\character\rank;
use gms\data\GMSDatabaseObject;

/**
 * Represents a character in guild.
 * 
 * @author	Jeffrey Reichardt
 * @copyright	{{COPYRIGHT}}
 * @package	com.guilded.gms
 * @category	{{PROJECT-CATEGORY}}
 */
class CharacterRank extends GMSDatabaseObject {
	/**
	 * @see	\wcf\data\DatabaseObject::$databaseTableName
	 */
	protected static $databaseTableName = 'character_rank';
	
	/**
	 * @see	\wcf\data\DatabaseObject::$databaseTableIndexName
	 */
	protected static $databaseTableIndexName = 'rankID';
}
