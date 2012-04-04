<?php
namespace wcf\data\character\option;
use wcf\data\AbstractDatabaseObjectAction;

/**
 * Executes character option-related actions.
 * 
 * @author 		Jeffrey Reichardt
 * @copyright	2012 Guilded.eu
 * @license		CC by-nc-sa
 * @package	com.guilded.wcf.character
 * @subpackage	data.character.option
 * @category 	Community Framework
 */
class CharacterOptionAction extends AbstractDatabaseObjectAction {
	/**
	 * @see	wcf\data\AbstractDatabaseObjectAction::$className
	 */
	protected $className = 'wcf\data\character\option\CharacterOptionEditor';
}
