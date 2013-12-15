<?php
namespace gms\data\game\server;
use wcf\data\AbstractDatabaseObjectAction;
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
class GameServerAction extends AbstractDatabaseObjectAction {
	/**
	 * @see	\wcf\data\AbstractDatabaseObjectAction::$className
	 */
	public $className = 'gms\data\game\server\GameServerEditor';
	
	/**
	 * @see	\wcf\data\AbstractDatabaseObjectAction::$permissionsCreate
	 */
	protected $permissionsCreate = array('user.gameserver.canAddGameServer');
	
	/**
	 * @see	\wcf\data\AbstractDatabaseObjectAction::$permissionsDelete
	 */
	protected $permissionsDelete = array('user.gameserver.canDeleteGameServer');
	
	/**
	 * @see	\wcf\data\AbstractDatabaseObjectAction::$permissionsUpdate
	 */
	protected $permissionsUpdate = array('user.gameserver.canEditGameServer');
}
