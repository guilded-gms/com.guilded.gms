<?php
namespace wcf\system\bbcode;
use wcf\data\guild\Guild;
use wcf\system\WCF;
use wcf\util\StringUtil;

class CharacterBBCode extends AbstractBBCode {
	/**
	* @see wcf\system\bbcode\IBBCode::getParsedTag()
	*/
	public function getParsedTag(array $openingTag, $content, array $closingTag, BBCodeParser $parser) {
		if (is_int($content)) {
			$guild = new Guild($content);
		}
		else {
			$guild = Guild::getGuildByName($content);
		}

		if ($guild === null) {
			return '';
		}
	
		if ($parser->getOutputType() == 'text/html') {
			WCF::getTPL()->assign(array(
				'guild' => $guild
			));
			
			return WCF::getTPL()->fetch('guildBBCodeTag', array(), false);
		}
		else if ($parser->getOutputType() == 'text/plain') {
			return $guild->name;
		}
	}
}
