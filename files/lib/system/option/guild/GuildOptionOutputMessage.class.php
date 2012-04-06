<?php
namespace wcf\system\option\guild;
use wcf\data\guild\option\GuildOption;
use wcf\data\guild\Guild;
use wcf\system\bbcode\MessageParser;

class GuildOptionOutputMessage implements IGuildOptionOutput {
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
		return $this->getOutput($guild, $option, $value);
	}
	
	/**
	 * @see wcf\system\option\guild\IGuildOptionOutput::getOutput()
	 */
	public function getOutput(Guild $guild, GuildOption $option, $value) {
		MessageParser::getInstance()->setOutputType('text/html');
		return MessageParser::getInstance()->parse($value);
	}
}
?>
