<?php
namespace wcf\system\bbcode;
use wcf\data\character\Character;
use wcf\system\WCF;
use wcf\util\StringUtil;

class CharacterBBCode extends AbstractBBCode {
	/**
	* @see wcf\system\bbcode\IBBCode::getParsedTag()
	*/
	public function getParsedTag(array $openingTag, $content, array $closingTag, BBCodeParser $parser) {
		if (is_int($content)) {
			$character = new Character($content);
		}
		else {
			$character = Character::getCharacterByName($content);
		}

		if ($character === null) {
			return '';
		}
	
		if ($parser->getOutputType() == 'text/html') {
			WCF::getTPL()->assign(array(
				'character' => $character
			));
			
			return WCF::getTPL()->fetch('characterBBCodeTag', array(), false);
		}
		else if ($parser->getOutputType() == 'text/plain') {
			return $character->name;
		}
	}
}