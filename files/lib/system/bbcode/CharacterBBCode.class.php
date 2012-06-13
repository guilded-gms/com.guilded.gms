<?php
namespace wcf\system\bbcode;
use wcf\data\Character;
use wcf\system\WCF;
use wcf\util\StringUtil;

class CharacterBBCode extends AbstractBBCode {
	/**
	* @see wcf\system\bbcode\IBBCode::getParsedTag()
	*/
	public function getParsedTag(array $openingTag, $content, array $closingTag, BBCodeParser $parser) {
		$character = Character::getCharacterByName($content);
		if (!$character->characterID) {
			return '';
		}
	
		if ($parser->getOutputType() == 'text/html') {
			WCF::getTPL()->assign(array(
				'character' => $character
			));
			return WCF::getTPL()->fetch('characterBBCodeTag', array(), false);
		}
		else if ($parser->getOutputType() == 'text/plain') {
			return $character->characterName;
		}
	}
}