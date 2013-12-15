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
class GuildOptionEditor extends GMSDatabaseObjectEditor {
	/**
	 * @see	\wcf\data\DatabaseObjectDecorator::$baseClass
	 */
	protected static $baseClass = 'gms\data\guild\option\GuildOption';
	
	/**
	 * @see	\wcf\data\IEditableObject::create()
	 */
	public static function create(array $parameters = array()) {
		$guildOption = parent::create($parameters);
		
		// alter the table "wcf".WCF_N."_guild_option_value" with this new option
		WCF::getDB()->getEditor()->addColumn('wcf'.WCF_N.'_guild_option_value', 'guildOption'.$guildOption->optionID, self::getColumnDefinition($parameters['optionType']));
		
			// add the default value to this column
		if (isset($parameters['$defaultValue'])) {
			$sql = "UPDATE	wcf".WCF_N."_guild_option_value
				SET	guildOption".$guildOption->optionID." = ?";
			$statement = WCF::getDB()->prepareStatement($sql);
			$statement->execute(array($parameters['defaultValue']));
		}
		
		return $guildOption;
	}
	
	/**
	 * @see	\wcf\data\IEditableObject::update()
	 */
	public function update(array $parameters = array()) {
		parent::update($parameters);
		
		// alter the table "wcf".WCF_N."_guild_option_value" with this new option
		WCF::getDB()->getEditor()->alterColumn(
			'wcf'.WCF_N.'_guild_option_value',
			'guildOption'.$this->optionID,
			'guildOption'.$this->optionID,
			self::getColumnDefinition($parameters['optionType'])
		);
	}
	
	/**
	 * @see	\wcf\data\IEditableObject::delete()
	 */
	public function delete() {
		$sql = "DELETE FROM	wcf".WCF_N."_guild_option
			WHERE		optionID = ?";
		$statement = WCF::getDB()->prepareStatement($sql);
		$statement->execute(array($this->optionID));
		
		$sql = WCF::getDB()->getEditor()->dropColumn('wcf'.WCF_N.'_guild_option_value', 'guildOption'.$this->optionID);
	}
	
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
		
		$sql = "UPDATE	wcf".WCF_N."_guild_option
			SET	disabled = ?
			WHERE	optionID = ?";
		$statement = WCF::getDB()->prepareStatement($sql);
		$statement->execute(array($value, $this->optionID));
	}
	
	/**
	 * Determines the needed sql statement to modify column definitions.
	 * 
	 * @param	string		$optionType
	 * @return	array		column definition
	 */
	public static function getColumnDefinition($optionType) {
		$column = array(
			'autoIncrement' => false,
			'key' => false,
			'notNull' => false,
			'type' => 'text'
		);
		
		switch ($optionType) {
			case 'boolean':
				$column['notNull'] = true;
				$column['default'] = 0;
				$column['length'] = 1;
				$column['type'] = 'tinyint';
			break;
			
			case 'integer':
				$column['notNull'] = true;
				$column['default'] = 0;
				$column['length'] = 10;
				$column['type'] = 'int';
			break;
			
			case 'float':
				$column['notNull'] = true;
				$column['default'] = 0.0;
				$column['type'] = 'float';
			break;
			
			case 'textarea':
				$column['type'] = 'mediumtext';
			break;
			
			case 'birthday':
			case 'date':
				$column['notNull'] = true;
				$column['default'] = "'0000-00-00'";
				$column['length'] = 10;
				$column['type'] = 'char';
			break;
		}
		
		return $column;
	}
}
