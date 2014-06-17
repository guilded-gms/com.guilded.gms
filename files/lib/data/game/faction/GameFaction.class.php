<?php
namespace gms\data\game\faction;
use gms\data\GMSDatabaseObject;

/**
 * Represents a game faction.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	data.game.faction
 * @category	Guilded 2.0
 */
class GameFaction extends GMSDatabaseObject {
	/**
	 * @see	\wcf\data\DatabaseObject::$databaseTableName
	 */
	protected static $databaseTableName = 'game_faction';
	
	/**
	 * @see	\wcf\data\DatabaseObject::$databaseTableIndexName
	 */
	protected static $databaseTableIndexName = 'factionID';

	/**
	 * Returns faction by given name and game.
	 *
	 * @param	string	$factionName
	 * @param	integer	$gameID
	 * @return	\gms\data\game\faction\GameFaction
	 */
	public static function getFactionByTitle($factionName, $gameID = GMS_DEFAULT_GAME_ID) {
		$sql = "SELECT	*
				FROM	".self::getDatabaseTableName()."
				WHERE	title = ? AND
						gameID = ?";
		$statement = WCF::getDB()->prepareStatement($sql);
		$statement->execute(array($factionName, $gameID));
		$row = $statement->fetchArray();

		if (!$row) $row = array();

		return new GameFaction(null, $row);
	}
}
