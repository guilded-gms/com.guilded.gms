<?php
namespace gms\data\guild\rank;
use gms\data\GMSDatabaseObject;

/**
 * Represents a rank in guild.
 * 
 * @author	Jeffrey Reichardt
 * @copyright	{{COPYRIGHT}}
 * @package	com.guilded.gms
 * @category	{{PROJECT-CATEGORY}}
 */
class GuildRank extends GMSDatabaseObject {
	/**
	 * @see	\wcf\data\DatabaseObject::$databaseTableName
	 */
	protected static $databaseTableName = 'guild_rank';
	
	/**
	 * @see	\wcf\data\DatabaseObject::$databaseTableIndexName
	 */
	protected static $databaseTableIndexName = 'rankID';

	/**
	 * Returns title of rank.
	 *
	 * @return    mixed|null
	 */
	public function getTitle() {
		return $this->name;
	}
}
