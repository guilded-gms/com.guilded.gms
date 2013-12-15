<?php
namespace gms\data\guild;
use wcf\system\exception\ValidateActionException;
use wcf\system\WCF;

/**
 * GuildProfile-related actions.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2013 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	data.guild
 * @category	Guilded 2.0
 */
class GuildProfileAction extends GuildAction {
	/**
	 * @see	\wcf\data\AbstractDatabaseObjectAction::$allowGuestAccess
	 */
	protected $allowGuestAccess = array('getGuildProfile');
		
	/**
	 * Validates guild profile preview.
	 */
	public function validateGetGuildProfile() {
		switch (count($this->objectIDs)) {
			case 0:
				throw new ValidateActionException("Missing guild id");
			break;
			case 1:
				return;
			break;
			default:
				// more than one guild id is pointless
				throw new ValidateActionException("Invalid parameter for guild id given");
			break;
		}
	}
	
	/**
	 * Returns guild profile preview.
	 * 
	 * @return	array
	 */
	public function getGuildProfile() {
		$guildID = reset($this->objectIDs);
		
		WCF::getTPL()->assign(array(
			'guild' => GuildProfile::getGuildProfile($guildID)
		));
		
		return array(
			'template' => WCF::getTPL()->fetch('guildProfilePreview')
		);
	}
}
