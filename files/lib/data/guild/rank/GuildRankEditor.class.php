<?php
namespace gms\data\guild\rank;
use wcf\data\DatabaseObjectEditor;

/**
 * Editor for GuildRank
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons <BY-NC-SA> (http://creativecommons.org/licenses/by-nc-sa/3.0/legalcode)
 * @package	com.guilded.gms
 * @subpackage	data.guild.rank
 * @category	Guilded 2.0
 */
class GuildRankEditor extends DatabaseObjectEditor {
	/**
	 * @see	\wcf\data\DatabaseObjectDecorator::$baseClass
	 */
	protected static $baseClass = 'gms\data\guild\rank\GuildRank';
}
