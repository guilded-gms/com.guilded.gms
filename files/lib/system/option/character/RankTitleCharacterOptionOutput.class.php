<?php
namespace gms\system\option\character;
use gms\data\character\option\CharacterOption;
use gms\data\character\Character;
use wcf\system\WCF;

/**
 * CharacterOptionOutputRankTitle is an implementation of ICharacterOptionOutput for the output the rank title and name.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons <BY-NC-SA> (http://creativecommons.org/licenses/by-nc-sa/3.0/legalcode)
 * @package	com.guilded.gms
 * @subpackage	system.option.character
 * @category	Guilded 2.0
 */
class RankTitleCharacterOptionOutput implements ICharacterOptionOutput {
	/**
	 * @see	\wcf\system\option\character\ICharacterOptionOutput::getShortOutput()
	 */
	public function getOutput(Character $character, CharacterOption $option, $value) {
		return $character->getTitledName();
	}
}
