<?php
namespace gms\system\package\plugin;
use wcf\data\package\Package;
use wcf\system\package\plugin\AbstractXMLPackageInstallationPlugin;
use wcf\system\WCF;

/**
 * Package-installation-plugin implementation for game.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	system.package.plugin
 * @category	Guilded 2.0
 *
 * @todo implement other pip's (race, class, faction, etc.)
 */
class GamePackageInstallationPlugin extends AbstractXMLPackageInstallationPlugin {
	/**
	 * @see	\wcf\system\package\plugin\AbstractXMLPackageInstallationPlugin::$className
	 */
	public $className = 'gms\data\game\GameEditor';
	
	/**
	 * @see	\wcf\system\package\plugin\AbstractPackageInstallationPlugin::$application
	 */
	public $application = 'gms';
	
	/**
	 * @see	\wcf\system\package\plugin\AbstractXMLPackageInstallationPlugin::handleDelete()
	 */
	protected function handleDelete(array $items) {
		$sql = "DELETE FROM	gms".WCF_N."_".$this->tableName." WHERE title = ?";
		$statement = WCF::getDB()->prepareStatement($sql);

		foreach ($items as $item) {
			$statement->execute(array(
				$item['attributes']['name']
			));
		}
	}
	
	/**
	 * @see	\wcf\system\package\plugin\AbstractXMLPackageInstallationPlugin::prepareImport()
	 */
	protected function prepareImport(array $data) {
		$abbreviation = Package::getAbbreviation($this->installation->getPackage()->package);

		return array(
			'packageID' => $this->installation->getPackageID(),
			'title' => $abbreviation,
			'icon' => (!isset($data['elements']['icon']) ? $abbreviation : $data['elements']['icon']),
			'level' => $data['elements']['level'],
			'race' => (!isset($data['elements']['races']) ? 1 : $data['elements']['races']),
			'class' => (!isset($data['elements']['classes']) ? 1 : $data['elements']['classes'])
		);
	}
	
	/**
	 * @see	\wcf\system\package\plugin\AbstractXMLPackageInstallationPlugin::findExistingItem()
	 */
	protected function findExistingItem(array $data) {
		$sql = "SELECT	*
				FROM gms".WCF_N."_".$this->tableName."
				WHERE title = ?";
		$parameters = array(
			Package::getAbbreviation($this->installation->getPackage()->getName())
		);
		
		return array(
			'sql' => $sql,
			'parameters' => $parameters
		);
	}

	/**
	 * @see	\wcf\system\package\plugin\AbstractXMLPackageInstallationPlugin
	 */
	protected function postImport() {
		parent::postImport();

		// set default game
		if (!defined('DEFAULT_GAME_ID') || !DEFAULT_GAME_ID) {
			$sql = "SELECT gameID
			FROM gms".WCF_N."_game";
			$statement = WCF::getDB()->prepareStatement($sql);
			$row = $statement->fetchArray();

			if ($row !== false) {
				$sql = "UPDATE	wcf".WCF_N."_option
				SET		optionValue = ?
				WHERE	optionName = ?";
				$statement = WCF::getDB()->prepareStatement($sql);
				$statement->execute(array($row['gameID'], 'default_game_id'));

				// set up default guild
				$guild = GuildEditor::create(array(
					'gameID' => $row['gameID'],
					'name' => 'Default Guild'
				));

				$sql = "UPDATE	wcf".WCF_N."_option
				SET		optionValue = ?
				WHERE	optionName = ?";
				$statement = WCF::getDB()->prepareStatement($sql);
				$statement->execute(array($guild->guildID, 'default_guild_id'));
			}
		}
	}
}
