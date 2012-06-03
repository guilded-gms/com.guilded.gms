<?php
namespace wcf\data\guild;

/**
 * Represents a list of character profiles.
 */
class GuildProfileList extends GuildList {
	/**
	 * @see	wcf\data\DatabaseObjectList::$sqlOrderBy
	 */
	public $sqlOrderBy = 'guild.guildName';
	
	/**
	 * decorator class name
	 * @var string
	 */
	public $decoratorClassName = 'wcf\data\guild\GuildProfile';
	
	/**
	 * @see	wcf\data\DatabaseObjectList::readObjects()
	 */
	public function readObjects() {
		if ($this->objectIDs === null) $this->readObjectIDs();
		parent::readObjects();
		
		foreach ($this->objects as $guildID => $guild) {
			$this->objects[$guildID] = new $this->decoratorClassName($guild);
		}
	}
}
