<?php
namespace gms\system\package\plugin;
use wcf\data\package\Package;
use wcf\system\package\plugin\AbstractXMLPackageInstallationPlugin;
use wcf\system\WCF;

/**
 * Package-installation-plugin implementation for game roles.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	system.package.plugin
 * @category	Guilded 2.0
 */
class GameRolePackageInstallationPlugin extends AbstractXMLPackageInstallationPlugin {
	/**
	 * @see	\wcf\system\package\plugin\AbstractXMLPackageInstallationPlugin::$className
	 */
	public $className = 'gms\data\game\role\GameRoleEditor';
	
	/**
	 * @see	\wcf\system\package\plugin\AbstractPackageInstallationPlugin::$tableName
	 */
	public $tableName = 'game_role';

	/**
	 * @see	\wcf\system\package\plugin\AbstractPackageInstallationPlugin::$application
	 */
	public $application = 'gms';

	/**
	 * @see	\wcf\system\package\plugin\AbstractPackageInstallationPlugin::$tagName
	 */
	public $tagName = 'role';
	
	/**
	 * @see	\wcf\system\package\plugin\AbstractXMLPackageInstallationPlugin::handleDelete()
	 */
	protected function handleDelete(array $items) {
		$sql = "DELETE FROM	gms".WCF_N."_".$this->tableName."
				WHERE title = ?";
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
		return array(
			'title' => $data['attributes']['name'],
			'identifier' => $data['elements']['identifier'],
			'icon' => (isset($data['elements']['icon']) ? $data['elements']['icon'] : $data['attributes']['name'])
		);
	}

	/**
	 * @see	\wcf\system\package\plugin\AbstractXMLPackageInstallationPlugin::findExistingItem()
	 */
	protected function findExistingItem(array $data) {
		$sql = "SELECT	*
				FROM	gms".WCF_N."_".$this->tableName."
				WHERE	title = ? AND
						gameID = ?";
		$parameters = array(
			$data['title'],
			$data['gameID']
		);

		return array(
			'sql' => $sql,
			'parameters' => $parameters
		);
	}
}
