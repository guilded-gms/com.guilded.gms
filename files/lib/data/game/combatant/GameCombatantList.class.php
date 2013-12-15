<?php
namespace gms\data\game\combatant;
use wcf\data\DatabaseObjectList;

class GameCombatantList extends DatabaseObjectList {
	/**
	 * @see	\wcf\data\DatabaseObjectList::$className
	 */
	public $className = 'gms\data\game\combatant\GameCombatant';
	
	/**
	 * @see DatabaseObjectList::__construct()
	 */
	public function __construct($instanceID) {
		parent::__construct();
		
		$this->conditionBuilder->add('instanceID = ?', $instanceID);
	}
}
