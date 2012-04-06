<?php
namespace wcf\data\guild;
use wcf\data\DatabaseObjectDecorator;
use wcf\system\database\util\PreparedStatementConditionBuilder;
use wcf\system\WCF;

/**
 * Decorates the guild object and provides functions to retrieve data for guild profiles.
 *
 * @author		Jeffrey Reichardt
 * @copyright	2012 Guilded.eu
 * @license		CC by-nc-sa
 * @package	com.guilded.wcf.guild
 * @subpackage	data.guild
 * @category 	Community Framework
 */
class GuildProfile extends DatabaseObjectDecorator {
	/**
	 * @see wcf\data\DatabaseObjectDecorator::$baseClass
	 */
	protected static $baseClass = 'wcf\data\guild\Guild';
	
	/**
	 * Returns image tag in given size.
	 */
	public function getImageTag($size = 0) {
		return '<img src="'.StringUtil::encodeHTML($this->image).'" alt=""'.($size > 0 ? ' style="max-width:'.$size.'px;max-height:'.$size.'px;"':'').' />';
	}	
}
