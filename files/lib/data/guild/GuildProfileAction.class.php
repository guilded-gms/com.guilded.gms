<?php
namespace wcf\data\guild;
use wcf\system\exception\ValidateActionException;
use wcf\system\WCF;
use wcf\util\StringUtil;

class GuildProfileAction extends GuildAction {
	/**
	 * @see	wcf\data\AbstractDatabaseObjectAction::$allowGuestAccess
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