<?php
namespace gms\data\guild\option;
use gms\data\guild\Guild;
use wcf\data\option\Option;
use wcf\system\WCF;

/**
 * Represents a guild option.
 * 
 * @author 		Jeffrey Reichardt
 * @copyright	2012 Guilded.eu
 * @license		CC by-nc-sa
 * @package	com.guilded.wcf.guild
 * @subpackage	data.guild.option
 * @category 	Community Framework
 */
class GuildOption extends Option {
	/**
	 * @see	\wcf\data\DatabaseObject::$databaseTableName
	 */
	protected static $databaseTableName = 'guild_option';
	
	/**
	 * @see	\wcf\data\DatabaseObject::$databaseTableIndexName
	 */
	protected static $databaseTableIndexName = 'optionID';
	
	/**
	 * option value
	 * @var	string
	 */
	public $optionValue = '';
	
	/**
	 * output data
	 * @var	array
	 */
	public $outputData = array();
	
	/**
	 * guild object
	 * @var	\gms\data\guild\Guild
	 */
	public $guild = null;
	
	/**
	 * Sets target guild object.
	 * 
	 * @param	\gms\data\guild\Guild	$guild
	 */
	public function setGuild(Guild $guild) {
		$this->guild = $guild;
	}
	
	/**
	 * @see	\wcf\data\option\Option::isVisible()
	 */
	public function isVisible() {
		// check if option is hidden
		if (!$this->visible) {
			return false;
		}
		
		// proceed if option is visible for all
		if ($this->visible & Option::VISIBILITY_GUEST) {
			$visible = true;
		}
		// proceed if option is visible for registered guilds and current guild is logged in
		else if (($this->visible & Option::VISIBILITY_REGISTERED) && WCF::getGuild()->guildID) {
			$visible = true;
		}
		else {
			$isAdmin = $isOwner = $visible = false;
			// check admin permissions
			if ($this->visible & Option::VISIBILITY_ADMINISTRATOR) {
				if (WCF::getSession()->getPermission('admin.general.canViewPrivateGuildOptions')) {
					$isAdmin = true;
				}
			}
			
			// check owner state
			if ($this->visible & Option::VISIBILITY_OWNER) {
				if ($this->guild !== null && $this->guild->guildID == WCF::getGuild()->guildID) {
					$isOwner = true;
				}
			}
			
			if ($isAdmin) {
				$visible = true;
			}
			else if ($isOwner) {
				$visible = true;
			}
		}
		
		if (!$visible || $this->disabled) return false;
		
		return true;
	}
}
