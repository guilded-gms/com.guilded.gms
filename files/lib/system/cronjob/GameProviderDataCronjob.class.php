<?php
namespace gms\system\cronjob;
use gms\data\game\server\GameServerEditor;
use gms\data\guild\GuildList;
use gms\system\game\GameHandler;
use wcf\data\cronjob\Cronjob;
use wcf\system\cronjob\AbstractCronjob;

/**
 * Synchronizes game data from external provider.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	system.cronjob
 * @category	Guilded 2.0
 */
class GameProviderDataCronjob extends AbstractCronjob {
	/**
	 * @see	\wcf\system\cronjob\ICronjob::execute()
	 */
	public function execute(Cronjob $cronjob) {
		parent::execute($cronjob);

		foreach (GameHandler::getGames() as $game) {
			$provider = $game->getProvider();
			if ($provider === null) {
				continue;
			}

			// get all guilds of this game
			$guildList = new GuildList();
			$guildList->getConditionBuilder()->add('guild.gameID = ?', array($game->gameID));
			$guildList->readObjects();

			foreach ($guildList as $guild) {
				$providerServer = $provider->getServer($guild->server);
				$providerGuild = $provider->getGuild($guild->server, $guild->name);

				// update server data
				if ($guild->getServer() !== null) {
					$serverEditor = new GameServerEditor($guild->getServer());
					$serverEditor->update(array(
						'isOnline' => $providerServer->isOnline,
						'queue' => $providerServer->queue,
						'population' => $providerServer->population
					));
				}
				else {
					GameServerEditor::create(array(
						'gameID' => $game->gameID,
						'name' => $providerServer->name,
						'type' => $providerServer->type,
						'isOnline' => $providerServer->isOnline,
						'queue' => $providerServer->queue,
						'population' => $providerServer->population
					));
				}

				// @todo update guild data, activities, etc.
				/*
				$guildAction = new GuildAction(array($guild->guildID), 'update', array(
					'data' => array(

					)
				));
				$guildAction->executeAction();
				*/
			}
		}
	}
}
