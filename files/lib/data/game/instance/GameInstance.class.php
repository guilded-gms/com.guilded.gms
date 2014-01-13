<?php
namespace gms\data\game\instance;
use gms\data\game\combatant\GameCombatantList;
use gms\data\GMSDatabaseObject;

/**
 * Represents a game instance.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	data.game.instance
 * @category	Guilded 2.0
 */
class GameInstance extends GMSDatabaseObject {
	/**
	 * @see	\wcf\data\DatabaseObject::$databaseTableName
	 */
	protected static $databaseTableName = 'game_instance';
	
	/**
	 * @see	\wcf\data\DatabaseObject::$databaseTableIndexName
	 */
	protected static $databaseTableIndexName = 'instanceID';

	/**
	 * list of combatants
	 * @var	\gms\data\game\combatant\GameCombatantList
	 */
	protected $combatantList = null;
	
	/**
	 * Returns list of combatants.
	 *
	 * @return	\gms\data\game\combatant\GameCombatantList
	 */
	public function getCombatantList() {
		if ($this->combatantList === null) {
			$this->combatantList = new GameCombatantList($this->instanceID);
			$this->combatantList->readObjects();
		}
	
		return $this->combatantList;
	}
}
