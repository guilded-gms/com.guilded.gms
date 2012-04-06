<?php
namespace wcf\system\option\character;
use wcf\data\character\option\GuildOption;
use wcf\data\character\Guild;

interface IGuildOptionOutput {
	/**
	 * Returns a short version of the html code for the output of the given user option.
	 * 
	 * @param	wcf\data\character\Guild		$character
	 * @param	wcf\data\character\option\GuildOption	$option
	 * @param	string				$value
	 * @return	string
	 */
	public function getShortOutput(Guild $character, GuildOption $option, $value);
	
	/**
	 * Returns a medium version of the html code for the output of the given character option.
	 * 
	 * @param	wcf\data\character\Guild		$character
	 * @param	wcf\data\character\option\GuildOption	$option
	 * @param	string				$value
	 * @return	string
	 */
	public function getMediumOutput(Guild $character, GuildOption $option, $value);
	
	/**
	 * Returns the html code for the output of the given character option.
	 * 
	 * @param	wcf\data\character\Guild		$character
	 * @param	wcf\data\character\option\GuildOption	$option
	 * @param	string				$value
	 * @return	string
	 */
	public function getOutput(Guild $character, GuildOption $option, $value);
}
?>
