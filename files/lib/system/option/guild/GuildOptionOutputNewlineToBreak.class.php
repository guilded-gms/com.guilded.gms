<?php
namespace gms\system\option\guild;
use gms\data\guild\option\GuildOption;
use gms\data\guild\Guild;
use wcf\util\StringUtil;

class GuildOptionOutputNewlineToBreak implements IGuildOptionOutput {
	/**
	 * @see	\wcf\system\option\guild\IGuildOptionOutput::getShortOutput()
	 */
	public function getShortOutput(Guild $guild, GuildOption $option, $value) {
		return $this->getOutput($guild, $option, $value);
	}
	
	/**
	 * @see	\wcf\system\option\guild\IGuildOptionOutput::getMediumOutput()
	 */
	public function getMediumOutput(Guild $guild, GuildOption $option, $value) {
		return $this->getOutput($guild, $option, $value);
	}
	
	/**
	 * @see	\wcf\system\option\guild\IGuildOptionOutput::getOutput()
	 */
	public function getOutput(Guild $guild, GuildOption $option, $value) {
		return nl2br(StringUtil::encodeHTML($value));
	}
}