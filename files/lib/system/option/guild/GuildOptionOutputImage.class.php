<?php
namespace wcf\system\option\guild;
use wcf\data\guild\option\GuildOption;
use wcf\data\guild\Guild;
use wcf\util\StringUtil;

class GuildOptionOutputImage implements IGuildOptionOutput {
	/**
	 * @see wcf\system\option\guild\IGuildOptionOutput::getShortOutput()
	 */
	public function getShortOutput(Guild $guild, GuildOption $option, $value) {
		return $this->getOutput($guild, $option, $value);
	}
	
	/**
	 * @see wcf\system\option\guild\IGuildOptionOutput::getMediumOutput()
	 */
	public function getMediumOutput(Guild $guild, GuildOption $option, $value) {
		if (empty($value)) return '';
		
		return '<img src="'.StringUtil::encodeHTML($value).'" alt="" style="max-width: 50px; max-height: 50px" />';
	}
	
	/**
	 * @see wcf\system\option\guild\IGuildOptionOutput::getOutput()
	 */
	public function getOutput(Guild $guild, GuildOption $option, $value) {
		if (empty($value)) return '';
		
		return '<img src="'.StringUtil::encodeHTML($value).'" alt="" />';
	}
}
?>
