<?php
namespace gms\system\search;
use gms\data\character\SearchResultCharacterList;
use wcf\system\search\AbstractSearchableObjectType;

/**
 * Character search.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	system.search
 * @category	Guilded 2.0
 */
class CharacterSearch extends AbstractSearchableObjectType {
	/**
	 * message data cache
	 * @var	array<\gms\data\character\SearchResultCharacter>
	 */
	public $messageCache = array();
	
	/**
	 * @see	\wcf\system\search\ISearchableObjectType::cacheObjects()
	 */
	public function cacheObjects(array $objectIDs, array $additionalData = null) {
		$characterList = new SearchResultCharacterList();
		$characterList->getConditionBuilder()->add('character_table.characterID IN (?)', array($objectIDs));
		$characterList->readObjects();

		foreach ($characterList->getObjects() as $character) {
			$this->messageCache[$character->characterID] = $character;
		}
	}

	/**
	 * @see	\wcf\system\search\ISearchableObjectType::getObject()
	 */
	public function getObject($objectID) {
		if (isset($this->messageCache[$objectID])) {
			return $this->messageCache[$objectID];
		}

		return null;
	}
	
	/**
	 * @see	\wcf\system\search\ISearchableObjectType::getTableName()
	 */
	public function getTableName() {
		return 'wcf'.WCF_N.'_character';
	}
	
	/**
	 * @see	\wcf\system\search\ISearchableObjectType::getIDFieldName()
	 */
	public function getIDFieldName() {
		return $this->getTableName().'.characterID';
	}
}
