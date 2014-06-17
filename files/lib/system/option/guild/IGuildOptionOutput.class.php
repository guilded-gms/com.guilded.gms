<?php
namespace gms\system\option\guild;
use gms\data\guild\Guild;
use gms\data\guild\option\GuildOption;

interface IGuildOptionOutput {
	/**
	 * Returns a short version of the html code for the output of the given user option.
	 * 
	 * @param	\gms\data\guild\Guild	$guild
	 * @param	\gms\data\guild\option\GuildOption	$option
	 * @param	string	$value
	 * @return	string
	 */
	public function getShortOutput(Guild $guild, GuildOption $option, $value);
	
	/**
	 * Returns a medium version of the html code for the output of the given guild option.
	 * 
	 * @param	\gms\data\guild\Guild	$guild
	 * @param	\gms\data\guild\option\GuildOption	$option
	 * @param	string	$value
	 * @return	string
	 */
	public function getMediumOutput(Guild $guild, GuildOption $option, $value);
	
	/**
	 * Returns the html code for the output of the given guild option.
	 * 
	 * @param	\gms\data\guild\Guild	$guild
	 * @param	\gms\data\guild\option\GuildOption	$option
	 * @param	string	$value
	 * @return	string
	 */
	public function getOutput(Guild $guild, GuildOption $option, $value);
}
