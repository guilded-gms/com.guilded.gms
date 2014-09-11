<?php
namespace wcf\system\package\plugin;
use gms\data\game\Game;
use gms\data\game\race\GameRace;
use gms\data\game\role\GameRole;
use wcf\data\package\Package;
use wcf\system\exception\SystemException;
use wcf\system\package\plugin\AbstractXMLPackageInstallationPlugin;
use wcf\system\WCF;
use wcf\util\ArrayUtil;

/**
 * Package-installation-plugin implementation for game classification.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	system.package.plugin
 * @category	Guilded 2.0
 */
class GameClassificationPackageInstallationPlugin extends AbstractXMLPackageInstallationPlugin {
	/**
	 * @see	\wcf\system\package\plugin\AbstractXMLPackageInstallationPlugin::$className
	 */
	public $className = 'gms\data\game\classification\GameClassificationEditor';
	
	/**
	 * @see	\wcf\system\package\plugin\AbstractPackageInstallationPlugin::$tableName
	 */
	public $tableName = 'game_classification';

	/**
	 * @see	\wcf\system\package\plugin\AbstractPackageInstallationPlugin::$application
	 */
	public $application = 'gms';

	/**
	 * @see	\wcf\system\package\plugin\AbstractPackageInstallationPlugin::$tagName
	 */
	public $tagName = 'classification';

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
				WHERE	title = ? AND
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

		// get handle races
		$races = array();
		if (isset($data['elements']['races'])) {
			$tmpRaces = ArrayUtil::trim(explode(',', $data['elements']['races']));
			foreach ($tmpRaces as $raceName) {
				$sql = "SELECT	*
						FROM	".GameRace::getDatabaseTableName()."
						WHERE	title = ? AND
								gameID = ?";
				$statement = WCF::getDB()->prepareStatement($sql);
				$statement->execute(array($raceName, $this->game->gameID));
				$row = $statement->fetchArray();

				if (!$row) {
					throw new SystemException('unable to find race with name: ' . $raceName . ' for classification: ' . $data['attributes']['name']);
				}

				$races[] = new GameRace(null, $row);
			}
		}

		// get handle roles
		$roles = array();
		if (isset($data['elements']['roles'])) {
			$tmpRoles = ArrayUtil::trim(explode(',', $data['elements']['roles']));
			foreach ($tmpRoles as $roleName) {
				$sql = "SELECT	*
						FROM	".GameRole::getDatabaseTableName()."
						WHERE	title = ? AND
								gameID = ?";
				$statement = WCF::getDB()->prepareStatement($sql);
				$statement->execute(array($roleName, $this->game->gameID));
				$row = $statement->fetchArray();

				if (!$row) {
					throw new SystemException('unable to find role with name: ' . $roleName . ' for classification: ' . $data['attributes']['name']);
				}

				$roles[] = new GameRole(null, $row);
			}
		}

		return array(
			'packageID' => $this->installation->getPackageID(),
			'title' => $data['attributes']['name'],
			'identifier' => (isset($data['elements']['identifier']) ? $data['elements']['identifier'] : ''),
			'gameID' => $this->game->gameID,
			'icon' => (isset($data['elements']['icon']) ? $data['elements']['icon'] : $data['attributes']['name']),
			'races' => $races,
			'roles' => $roles
		);
	}

	/**
	 * @see	\wcf\system\package\plugin\AbstractXMLPackageInstallationPlugin::findExistingItem()
	 */
	protected function import(array $row, array $data) {
		$races = $data['races'];
		$roles = $data['roles'];

		unset($data['races']);
		unset($data['roles']);

		// import race by given data
		$classification = parent::import($row, $data);

		// add race dependency
		foreach ($races as $race) {
			$sql = "INSERT INTO gms" . WCF_N . "_game_classification_to_race(classificationID, raceID)
					VALUES (?, ?)";
			$statement = WCF::getDB()->prepareStatement($sql);
			$statement->execute(array($classification->classificationID, $race->raceID));
		}

		// add role dependency
		foreach ($roles as $role) {
			$sql = "INSERT INTO gms" . WCF_N . "_game_classification_to_role(classificationID, roleID)
					VALUES (?, ?)";
			$statement = WCF::getDB()->prepareStatement($sql);
			$statement->execute(array($classification->classificationID, $role->roleID));
		}

		return $classification;
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
