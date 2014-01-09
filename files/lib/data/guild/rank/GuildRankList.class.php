<?php
namespace gms\data\guild\rank;
use wcf\data\DatabaseObjectList;

/**
 * Represents a list of guild ranks.
 *
 * @author	Jeffrey Reichardt
 * @copyright	{{COPYRIGHT}}
 * @package	com.guilded.gms
 * @category	{{PROJECT-CATEGORY}}
 */
class GuildRankList extends DatabaseObjectList {
	/**
	 * @see	\wcf\data\DatabaseObjectList::$className
	 */
	public $className = 'gms\data\guild\rank\GuildRank';
}
