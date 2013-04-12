<?php
namespace wcf\data\character\option;
use wcf\data\DatabaseObjectEditor;
use wcf\system\WCF;

/**
 * Provides functions to edit character options.
 * 
 * @author	Jeffrey Reichardt
 * @copyright	2012-2013 DevLabor UG (haftungsbeschränkt)
 * @license	CC BY-NC-SA 3.0 <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.wcf.character
 * @subpackage	data.character.option
 * @category	Guilded 2.0
 */
class CharacterOptionEditor extends DatabaseObjectEditor {
	/**
	 * @see	wcf\data\DatabaseObjectDecorator::$baseClass
	 */
	protected static $baseClass = 'wcf\data\character\option\CharacterOption';
	
	/**
	 * Disables this option.
	 */
	public function disable() {
		$this->enable(false);
	}
	
	/**
	 * Enables this option.
	 * 
	 * @param 	boolean		$enable
	 */
	public function enable($enable = true) {
		$value = intval(!$enable);
		
		$sql = "UPDATE	wcf".WCF_N."_character_option
				SET	disabled = ?
				WHERE	optionID = ?";
		$statement = WCF::getDB()->prepareStatement($sql);
		$statement->execute(array($value, $this->optionID));
	}
}
