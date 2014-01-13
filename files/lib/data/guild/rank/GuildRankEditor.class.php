<?php
namespace gms\data\guild\rank;
use wcf\data\DatabaseObjectEditor;

/**
 * Editor for GuildRank
 * 
 * @author	Jeffrey Reichardt
 * @copyright	{{COPYRIGHT}}
 * @package	com.guilded.gms
 * @category	{{PROJECT-CATEGORY}}
 */
class GuildRankEditor extends DatabaseObjectEditor {
	/**
	 * @see	\wcf\data\DatabaseObjectDecorator::$baseClass
	 */
	protected static $baseClass = 'gms\data\guild\rank\GuildRank';
}
