<?php
namespace gms\data\character\group;
use gms\data\character\CharacterProfile;
use gms\data\GMSDatabaseObject;
use wcf\system\WCF;

/**
 * Represents a group of character. E.g. battle or raid groups
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	data.character
 * @category	Guilded 2.0
 */
class CharacterGroup extends GMSDatabaseObject {
	/**
	 * @see	\wcf\data\DatabaseObject::$databaseTableName
	 */
	protected static $databaseTableName = 'character_group';
	
	/**
	 * @see	\wcf\data\DatabaseObject::$databaseTableIndexName
	 */
	protected static $databaseTableIndexName = 'groupID';

	/**
	 * list of group members
	 * @var array
	 */
	protected $characters = array();

	/**
	 * Returns a list of all group members.
	 *
	 * @return	array
	 */
	public function getCharacters() {
		if (empty($this->characters)) {
			$sql = "SELECT
						character_group_to_character.*
					FROM 	gms".WCF_N."_character_group_to_character character_group_to_character
					WHERE	character_group_to_character.groupID = ?";
			$statement = WCF::getDB()->prepareStatement($sql);
			$statement->execute(array($this->groupID));

			while ($row = $statement->fetchArray()) {
				$this->characters[] = CharacterProfile::getCharacterProfile($row['characterID']);
			}
		}

		return $this->characters;
	}
}
