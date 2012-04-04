<?php
namespace wcf\data\character;
use wcf\data\DatabaseObjectDecorator;
use wcf\system\database\util\PreparedStatementConditionBuilder;
use wcf\system\WCF;

/**
 * Decorates the character object and provides functions to retrieve data for character profiles.
 *
 * @author		Jeffrey Reichardt
 * @copyright	2012 Guilded.eu
 * @license		CC by-nc-sa
 * @package	com.guilded.wcf.character
 * @subpackage	data.character
 * @category 	Community Framework
 */
class CharacterProfile extends DatabaseObjectDecorator {
	/**
	 * @see wcf\data\DatabaseObjectDecorator::$baseClass
	 */
	protected static $baseClass = 'wcf\data\character\Character';
		
	const GENDER_MALE = 1;
	const GENDER_FEMALE = 2;
}
