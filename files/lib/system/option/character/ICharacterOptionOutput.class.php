<?php
namespace wcf\system\option\character;
use wcf\data\character\option\CharacterOption;
use wcf\data\character\Character;

interface ICharacterOptionOutput {
	/**
	 * Returns a short version of the html code for the output of the given user option.
	 * 
	 * @param	wcf\data\character\Character		$character
	 * @param	wcf\data\character\option\CharacterOption	$option
	 * @param	string				$value
	 * @return	string
	 */
	public function getShortOutput(Character $character, CharacterOption $option, $value);
	
	/**
	 * Returns a medium version of the html code for the output of the given character option.
	 * 
	 * @param	wcf\data\character\Character		$character
	 * @param	wcf\data\character\option\CharacterOption	$option
	 * @param	string				$value
	 * @return	string
	 */
	public function getMediumOutput(Character $character, CharacterOption $option, $value);
	
	/**
	 * Returns the html code for the output of the given character option.
	 * 
	 * @param	wcf\data\character\Character		$character
	 * @param	wcf\data\character\option\CharacterOption	$option
	 * @param	string				$value
	 * @return	string
	 */
	public function getOutput(Character $character, CharacterOption $option, $value);
}
?>
