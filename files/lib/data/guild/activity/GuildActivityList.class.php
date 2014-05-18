<?php
namespace gms\data\guild\activity;
use wcf\data\DatabaseObjectList;

/**
 * Represents a list of guild activities.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons <BY-NC-SA> (http://creativecommons.org/licenses/by-nc-sa/3.0/legalcode)
 * @package	com.guilded.gms
 * @subpackage	data.guild.activity
 * @category	Guilded 2.0
 */
class GuildActivityList extends DatabaseObjectList {
	/**
	 * @see	\wcf\data\DatabaseObjectList::$className
	 */
	public $className = 'gms\data\guild\activity\GuildActivity';
}
