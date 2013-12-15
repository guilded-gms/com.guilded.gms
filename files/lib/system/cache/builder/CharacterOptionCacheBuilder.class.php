<?php
namespace gms\system\cache\builder;
use wcf\data\option\category\OptionCategory;
use wcf\system\database\util\PreparedStatementConditionBuilder;
use wcf\system\WCF;

/**
 * Caches options and option categories for characters
 */
class CharacterOptionCacheBuilder extends OptionCacheBuilder {
	/**
	 * option class name
	 * @var	string
	 */
	protected $optionClassName = 'gms\data\character\option\CharacterOption';
	
	/**
	 * database table name
	 * @var	string
	 */
	protected $tableName = 'character_option';
}
