<?php
namespace gms\system\option\character;
use gms\data\character\Character;
use gms\data\character\CharacterProfile;
use gms\data\character\option\CharacterOption;
use wcf\system\WCF;

/**
 * CharacterOptionOutputGender is an implementation of ICharacterOptionOutput for the output the gender option.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons <BY-NC-SA> (http://creativecommons.org/licenses/by-nc-sa/3.0/legalcode)
 * @package	com.guilded.gms
 * @subpackage	system.option.character
 * @category	Guilded 2.0
 */
class GenderCharacterOptionOutput extends SelectOptionsCharacterOptionOutput {
	/**
	 * @see	\wcf\system\option\character\ICharacterOptionOutput::getShortOutput()
	 */
	public function getOutput(Character $character, CharacterOption $option, $value) {
		if ($value == CharacterProfile::GENDER_MALE) {
			$title = WCF::getLanguage()->getDynamicVariable('gms.character.profile.gender.male', array('name' => $character->name));
			return '<span class="icon icon-16 icon-male" title="' . $title . '"></span> ' . $title;
		}
		else if ($value == CharacterProfile::GENDER_FEMALE) {
			$title = WCF::getLanguage()->getDynamicVariable('gms.character.profile.gender.female', array('name' => $character->name));
			return '<span class="icon icon-16 icon-female" title="' . $title . '"></span> ' . $title;
		}

		return '';
	}
}
