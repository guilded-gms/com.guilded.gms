<?php
namespace gms\data\guild;

/**
 * Represents a list of search results of guilds.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.wcf.guild
 * @subpackage	data.guild
 * @category	Guilded 2.0
 */
class SearchResultGuildList extends GuildProfileList {
	/**
	 * @see	\wcf\data\DatabaseObjectList::$decoratorClassName
	 */
	public $decoratorClassName = 'gms\data\guild\SearchResultGuild';
}
