<?php
namespace gms\system\bbcode;
use gms\data\character\Character;
use wcf\system\bbcode\AbstractBBCode;
use wcf\system\bbcode\BBCodeParser;
use wcf\system\WCF;

/**
 * BBCode for linking characters.
 * Example: [character]kivah[/character] or [character]23[/character]
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons <BY-NC-SA> (http://creativecommons.org/licenses/by-nc-sa/3.0/legalcode)
 * @package	com.guilded.gms
 * @subpackage	system.bbcode
 * @category	Guilded 2.0
 */
class CharacterBBCode extends AbstractBBCode {
	/**
	 * @see	\wcf\system\bbcode\IBBCode::getParsedTag()
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
			
			return WCF::getTPL()->fetch('characterBBCodeTag');
		}
		else if ($parser->getOutputType() == 'text/plain') {
			return $character->name;
		}

		return '';
	}
}
