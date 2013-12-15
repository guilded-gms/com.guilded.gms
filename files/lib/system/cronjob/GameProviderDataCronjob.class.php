<?php
namespace gms\system\cronjob;
use gms\data\game\server\GameServerEditor;
use gms\data\guild\GuildList;
use wcf\data\cronjob\Cronjob;
use wcf\system\cronjob\AbstractCronjob;
use wcf\system\game\GameHandler;
use wcf\system\WCF;

/**
 * Synchronizes game data from external provider.
 * 
 * @author	Jeffrey Reichardt
 * @copyright	{{COPYRIGHT}}
 * @package	com.guilded.gms
 * @category	{{PROJECT-CATEGORY}}
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

				// @todo update guild data
			}
		}
	}
}
