<?php
namespace gms\system\bbcode;
use gms\data\guild\Guild;
use wcf\system\WCF;

/**
 * BBCode for linking guilds.
 * Example: [guild]paradoxum[/guild] or [guild]42[/guild]
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons <BY-NC-SA> (http://creativecommons.org/licenses/by-nc-sa/3.0/legalcode)
 * @package	com.guilded.gms
 * @subpackage	system.bbcode
 * @category	Guilded 2.0
 */
class GuildBBCode extends AbstractBBCode {
	/**
	 * @see	\wcf\system\bbcode\IBBCode::getParsedTag()
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
			
			return WCF::getTPL()->fetch('guildBBCodeTag');
		}
		else if ($parser->getOutputType() == 'text/plain') {
			return $guild->name;
		}

		return '';
	}
}
