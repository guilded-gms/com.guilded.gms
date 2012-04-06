<?php
namespace wcf\data\guild\option;
use wcf\data\AbstractDatabaseObjectAction;

/**
 * Executes guild option-related actions.
 * 
 * @author 		Jeffrey Reichardt
 * @copyright	2012 Guilded.eu
 * @license		CC by-nc-sa
 * @package	com.guilded.wcf.guild
 * @subpackage	data.guild.option
 * @category 	Community Framework
 */
class GuildOptionAction extends AbstractDatabaseObjectAction {
	/**
	 * @see	wcf\data\AbstractDatabaseObjectAction::$className
	 */
	protected $className = 'wcf\data\guild\option\GuildOptionEditor';
}
