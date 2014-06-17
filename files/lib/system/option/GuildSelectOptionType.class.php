<?php
namespace gms\system\option;
use gms\data\guild\GuildList;

/**
 * Select Option for guilds.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	system.option
 * @category	Guilded 2.0
 */
class GuildSelectOptionType extends GameSelectOptionType {
	/**
	 * game object
	 * @var	\gms\data\game\Game
	 */
	protected $game = null;

	/**
	 * Get possible select-options.
	 *
	 * @return array
	 */
	public function parseSelectOptions(){
		// @todo handle guild select mode (require application, free for all, etc.) acl?
		$result = array();

		$guildList = new GuildList();

		if ($this->game !== null) {
			$guildList->getConditionBuilder()->add('gameID = ?', array($this->game->gameID));
		}

		$guildList->readObjects();

		foreach ($guildList->getObjects() as $guild) {
			$result[$guild->guildID] = $guild->getTitle();
		}

		return $result;
	}
}
