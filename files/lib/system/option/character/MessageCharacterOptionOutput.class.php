<?php
namespace gms\system\option\character;
use gms\data\character\Character;
use gms\data\character\option\CharacterOption;
use wcf\system\bbcode\MessageParser;
use wcf\system\WCF;
use wcf\util\StringUtil;

class MessageCharacterOptionOutput implements ICharacterOptionOutput {
	/**
	 * @see	\wcf\system\option\user\IUserOptionOutput::getOutput()
	 */
	public function getOutput(Character $character, CharacterOption $option, $value) {
		$value = StringUtil::trim($value);
		if (empty($value)) {
			return '';
		}
		
		MessageParser::getInstance()->setOutputType('text/html');
		
		WCF::getTPL()->assign(array(
			'option' => $option,
			'value' => MessageParser::getInstance()->parse($value),
		));

		return WCF::getTPL()->fetch('messageCharacterOptionOutput');
	}
}
