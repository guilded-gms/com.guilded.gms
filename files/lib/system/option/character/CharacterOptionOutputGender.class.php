<?php
namespace wcf\system\option\character;
use wcf\data\character\option\CharacterOption;
use wcf\data\character\Character;
use wcf\data\character\CharacterProfile;
use wcf\system\style\StyleHandler;
use wcf\system\WCF;

/**
 * CharacterOptionOutputGender is an implementation of ICharacterOptionOutput for the output the gender option.
 *
 * @author		Jeffrey Reichardt
 * @copyright	2012 guilded.eu
 * @license		CC by-nc-sa
 * @package	com.guilded.wcf.character
 * @subpackage	system.option.character
 * @category 	Community Framework
 */
class CharacterOptionOutputGender extends CharacterOptionOutputSelectOptions {
	/**
	 * @see wcf\system\option\character\ICharacterOptionOutput::getShortOutput()
	 */
	public function getShortOutput(Character $character, CharacterOption $option, $value) {
		if ($value == CharacterProfile::GENDER_MALE) {
			$title = WCF::getLanguage()->getDynamicVariable('wcf.character.profile.gender.male', array('name' => $character->name));
			return '<img src="'.StyleHandler::getInstance()->getStyle()->getIconPath('genderMale', 'S').'" alt="'.$title.'" title="'.$title.'" />';
		}
		else if ($value == CharacterProfile::GENDER_FEMALE) {
			$title = WCF::getLanguage()->getDynamicVariable('wcf.character.profile.gender.female', array('name' => $character->name));
			return '<img src="'.StyleHandler::getInstance()->getStyle()->getIconPath('genderFemale', 'S').'" alt="'.$title.'" title="'.$title.'" />';
		}
		else {
			return '';
		}
	}
}
?>
