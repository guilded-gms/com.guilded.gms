<?php
namespace gms\data\game\server;
use wcf\data\DatabaseObjectList;

/**
 * List of Game Servers.
 * 
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)*
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	data.game.server
 * @category	Guilded 2.0
 */
class GameServerList extends DatabaseObjectList {
	/**
	 * @see	\wcf\data\DatabaseObjectList::$className
	 */
	public $className = 'gms\data\game\server\GameServer';
}
