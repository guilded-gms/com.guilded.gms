<?php
namespace gms\data\guild\option;
use wcf\data\DatabaseObjectEditor;
use wcf\system\WCF;

/**
 * Provides functions to edit guild options.
 * 
 * @author 		Jeffrey Reichardt
 * @copyright	2012 Guilded.eu
 * @license		CC by-nc-sa
 * @package	com.guilded.wcf.guild
 * @subpackage	data.guild.option
 * @category 	Community Framework
 */
class GuildOptionEditor extends DatabaseObjectEditor {
	/**
	 * @see	\wcf\data\DatabaseObjectDecorator::$baseClass
	 */
	protected static $baseClass = 'gms\data\guild\option\GuildOption';

	/**
	 * Disables this option.
	 */
	public function disable() {
		$this->enable(false);
	}
	
	/**
	 * Enables this option.
	 * 
	 * @param	boolean		$enable
	 */
	public function enable($enable = true) {
		$sql = "UPDATE	".GuildOption::getDatabaseTableName()."
				SET		disabled = ?
				WHERE	optionID = ?";
		$statement = WCF::getDB()->prepareStatement($sql);
		$statement->execute(array(intval(!$enable), $this->optionID));
	}
}
