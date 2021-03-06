<?php
namespace wcf\system\package\plugin;
use gms\data\game\faction\GameFaction;
use gms\data\game\Game;
use wcf\data\package\Package;
use wcf\system\exception\SystemException;
use wcf\system\package\plugin\AbstractXMLPackageInstallationPlugin;
use wcf\system\WCF;
use wcf\util\ArrayUtil;

/**
 * Package-installation-plugin implementation for game race.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	system.package.plugin
 * @category	Guilded 2.0
 */
class GameRacePackageInstallationPlugin extends AbstractXMLPackageInstallationPlugin {
	/**
	 * @see	\wcf\system\package\plugin\AbstractXMLPackageInstallationPlugin::$className
	 */
	public $className = 'gms\data\game\race\GameRaceEditor';
	
	/**
	 * @see	\wcf\system\package\plugin\AbstractPackageInstallationPlugin::$tableName
	 */
	public $tableName = 'game_race';

	/**
	 * @see	\wcf\system\package\plugin\AbstractPackageInstallationPlugin::$application
	 */
	public $application = 'gms';

	/**
	 * @see	\wcf\system\package\plugin\AbstractPackageInstallationPlugin::$tagName
	 */
	public $tagName = 'race';

	/**
	 * game object
	 * @var    null
	 */
	public $game = null;

	/**
	 * @see	\wcf\system\package\plugin\AbstractXMLPackageInstallationPlugin::handleDelete()
	 */
	protected function handleDelete(array $items) {
		// get game id
		$abbreviation = Package::getAbbreviation($this->installation->getPackage()->package);
		$this->game = Game::getGameByAbbreviation($abbreviation);

		if ($this->game === null || !$this->game->gameID) {
			return;
		}

		$sql = "DELETE FROM	gms".WCF_N."_".$this->tableName."
				WHERE 	title = ? AND
						gameID = ?";
		$statement = WCF::getDB()->prepareStatement($sql);

		foreach ($items as $item) {
			$statement->execute(array(
				$item['attributes']['name'],
				$this->game->gameID
			));
		}
	}
	
	/**
	 * @see	\wcf\system\package\plugin\AbstractXMLPackageInstallationPlugin::prepareImport()
	 */
	protected function prepareImport(array $data) {
		// get game id
		$abbreviation = Package::getAbbreviation($this->installation->getPackage()->package);
		$this->game = Game::getGameByAbbreviation($abbreviation);

		if ($this->game === null || !$this->game->gameID) {
			return array();
		}

		// get handle factions
		$factions = array();
		if (isset($data['elements']['factions'])) {
			$tmpFactions = ArrayUtil::trim(explode(',', $data['elements']['factions']));
			foreach ($tmpFactions as $factionName) {
				$sql = "SELECT	*
						FROM	".GameFaction::getDatabaseTableName()."
						WHERE	title = ? AND
								gameID = ?";
				$statement = WCF::getDB()->prepareStatement($sql);
				$statement->execute(array($factionName, $this->game->gameID));
				$row = $statement->fetchArray();

				if (!$row) {
					throw new SystemException('unable to find faction with name: ' . $factionName . ' for race: ' . $data['attributes']['name']);
				}

				$factions[] = new GameFaction(null, $row);
			}
		}

		return array(
			'packageID' => $this->installation->getPackageID(),
			'title' => $data['attributes']['name'],
			'identifier' => (isset($data['elements']['identifier']) ? $data['elements']['identifier'] : ''),
			'gameID' => $this->game->gameID,
			'icon' => (isset($data['elements']['icon']) ? $data['elements']['icon'] : $data['attributes']['name']),
			'factions' => $factions
		);
	}

	/**
	 * @see	\wcf\system\package\plugin\AbstractXMLPackageInstallationPlugin::findExistingItem()
	 */
	protected function import(array $row, array $data) {
		$factions = $data['factions'];
		unset($data['factions']);

		// import race by given data
		$race = parent::import($row, $data);

		// add faction dependency
		foreach ($factions as $faction) {
			$sql = "INSERT INTO gms" . WCF_N . "_game_race_to_faction(raceID, factionID)
					VALUES (?, ?)";
			$statement = WCF::getDB()->prepareStatement($sql);
			$statement->execute(array($race->raceID, $faction->factionID));
		}

		return $race;
	}

	/**
	 * @see	\wcf\system\package\plugin\AbstractXMLPackageInstallationPlugin::findExistingItem()
	 */
	protected function findExistingItem(array $data) {
		if (!isset($data['title'])) {
			return null;
		}

		$sql = "SELECT	*
				FROM	gms".WCF_N."_".$this->tableName."
				WHERE	title = ? AND
						gameID = ?";
		$parameters = array(
			$data['title'],
			$this->game->gameID
		);

		return array(
			'sql' => $sql,
			'parameters' => $parameters
		);
	}
}
