<?php
namespace gms\data\character\rank;
use wcf\data\AbstractDatabaseObjectAction;
use wcf\system\WCF;

/**
 * 
 * 
 * @author	Jeffrey Reichardt
 * @copyright	{{COPYRIGHT}}
 * @package	com.guilded.gms
 * @category	{{PROJECT-CATEGORY}}
 */
class CharacterRankAction extends AbstractDatabaseObjectAction {
	/**
	 * @see	\wcf\data\AbstractDatabaseObjectAction::$className
	 */
	public $className = 'gms\data\character\rank\CharacterRankEditor';
	
	/**
	 * @see	\wcf\data\AbstractDatabaseObjectAction::$permissionsCreate
	 */
	protected $permissionsCreate = array('admin.gms.character.canManageRank');
	
	/**
	 * @see	\wcf\data\AbstractDatabaseObjectAction::$permissionsDelete
	 */
	protected $permissionsDelete = array('admin.gms.character.canManageRank');
	
	/**
	 * @see	\wcf\data\AbstractDatabaseObjectAction::$permissionsUpdate
	 */
	protected $permissionsUpdate = array('admin.gms.character.canManageRank');
}
