<?php
namespace gms\system\option\character;
use gms\data\character\option\CharacterOption;
use gms\data\character\Character;

/**
 * Interface for CharacterOption output.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2013 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons <BY-NC-SA> (http://creativecommons.org/licenses/by-nc-sa/3.0/legalcode)
 * @package	com.guilded.gms
 * @subpackage	system.option.character
 * @category	Guilded 2.0
 */
interface ICharacterOptionOutput {
	/**
	 * Returns a short version of the html code for the output of the given user option.
	 * 
	 * @param	\gms\data\character\Character		$character
	 * @param	\gms\data\character\option\CharacterOption	$option
	 * @param	string				$value
	 * @return	string
	 */
	public function getShortOutput(Character $character, CharacterOption $option, $value);
	
	/**
	 * Returns a medium version of the html code for the output of the given character option.
	 * 
	 * @param	\gms\data\character\Character		$character
	 * @param	\gms\data\character\option\CharacterOption	$option
	 * @param	string				$value
	 * @return	string
	 */
	public function getMediumOutput(Character $character, CharacterOption $option, $value);
	
	/**
	 * Returns the html code for the output of the given character option.
	 * 
	 * @param	\gms\data\character\Character		$character
	 * @param	\gms\data\character\option\CharacterOption	$option
	 * @param	string				$value
	 * @return	string
	 */
	public function getOutput(Character $character, CharacterOption $option, $value);
}
