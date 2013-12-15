<?php
namespace gms\data\game\server;
use wcf\data\DatabaseObjectEditor;
use wcf\system\WCF;

/**
 * 
 * 
 * @author	Jeffrey Reichardt
 * @copyright	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	data.game.server
 * @category	Guilded 2.0
 */
class GameServerEditor extends DatabaseObjectEditor {
	/**
	 * @see	\wcf\data\DatabaseObjectDecorator::$baseClass
	 */
	protected static $baseClass = 'gms\data\game\server\GameServer';
}
