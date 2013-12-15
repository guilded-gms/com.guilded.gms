<?php
namespace gms\system\credit;
use wcf\system\SingletonFactory;
use wcf\data\object\type\ObjectTypeCache;
use wcf\system\cache\CacheHandler;

/**
 * Handles credits of DatabaseObjects.
 * 
 * @author	Jeffrey Reichardt
 * @copyright	2012-2013 DevLabor UG (haftungsbeschränkt)
 * @license	CC BY-NC-SA 3.0 <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	system.credit
 * @category	Guilded 2.0
 */
class CreditHandler extends SingletonFactory {
	/**
	 * cached credits
	 * @var	array<wcf\data\credit\Credit>
	 */
	protected $credits = array();

	/**
	 * maps each credit id to its object type id and object type credit id
	 * @var	array<array>
	 */
	protected $creditIDs = array();

	/**
	 * mapes the names of the credit object types to the object type ids
	 * @var	array<integer>
	 */
	protected $objectTypeIDs = array();

	/**
	 * list of credit object types
	 * @var	array<wcf\data\object\type>
	 */
	protected $objectTypes = array();

	/**
	 * Returns all credit of object with the given object type id and object id.
	 * 
	 * @param	integer	$objectTypeID
	 * @return	array<wcf\data\credit\Credit>
	 */
	public function getCredits($objectTypeID) {
		if (isset($this->credits[$objectTypeID])) {
			return $this->credits[$objectTypeID];
		}

		return array();
	}

	/**
	 * Returns the database object with the given credit id.
	 * 
	 * @param	integer	$objectTypeID
	 * @param	integer	$objectID
	 * @return	wcf\data\credit\Credit
	 */
	public function getCreditsByID($objectTypeID, $objectID) {
		if (isset($this->creditIDs[$objectTypeID][$objectID])) {
			return $this->creditIDs[$objectTypeID][$objectID];
		}

		return null;
	}

	/**
	 * Gets the object type with the given id.
	 * 
	 * @param	integer	$objectTypeID
	 * @return	wcf\data\object\type\ObjectType
	 */
	public function getObjectType($objectTypeID) {
		if (isset($this->objectTypeIDs[$objectTypeID])) {
			return $this->getObjectTypeByName($this->objectTypeIDs[$objectTypeID]);
		}

		return null;
	}

	/**
	 * Gets the object type with the given name.
	 * 
	 * @param	string	$objectTypeName
	 * @return	wcf\data\object\type\ObjectType
	 */
	public function getObjectTypeByName($objectTypeName) {
		if (isset($this->objectTypes[$objectTypeName])) {
			return $this->objectTypes[$objectTypeName];
		}

		return null;
	}

	/**
	 * @see	wcf\system\SingletonFactory::init()
	 */
	protected function init() {
		$this->objectTypes = ObjectTypeCache::getInstance()->getObjectTypes('com.guilded.gmsableObject');
		
		foreach ($this->objectTypes as $objectType) {
			$this->objectTypeIDs[$objectType->objectTypeID] = $objectType->objectType;
		}

		$cacheName = 'credit';

	}

	/**
	 * Reloads the credit cache.
	 */
	public function reloadCache() {
		CacheHandler::getInstance()->clearResource('credit');

		$this->init();
	}
	
	/**
	 * Returns a list of object types
	 * 
	 * @return	array<wcf\data\object\type\ObjectType>
	 */
	public function getObjectTypes() {
		return $this->objectTypes;
	}
}
