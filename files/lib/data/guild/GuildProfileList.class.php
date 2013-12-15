<?php
namespace gms\data\guild;

/**
 * Represents a list of character profiles.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2013 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	data.guild
 * @category	Guilded 2.0
 */
class GuildProfileList extends GuildList {
	/**
	 * @see	\wcf\data\DatabaseObjectList::$sqlOrderBy
	 */
	public $sqlOrderBy = 'guild.name';
	
	/**
	 * decorator class name
	 * @var string
	 */
	public $decoratorClassName = 'gms\data\guild\GuildProfile';
}
