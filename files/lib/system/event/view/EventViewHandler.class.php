<?php
namespace gms\system\event\view;

use wcf\data\object\type\ObjectTypeCache;
use wcf\system\SingletonFactory;

class EventViewHandler extends SingletonFactory {
	/**
	 * list of available object types
	 * @var array
	 */
	protected $objectTypes = array();
	
	/**
	 * @see wcf\system\SingletonFactory::init()
	 */
	protected function init() {
		// get available object types
		$this->objectTypes = ObjectTypeCache::getInstance()->getObjectTypes('com.guilded.gms.event.view');
		foreach ($this->objectTypes as $typeName => $object) {
			$this->objectTypes[$typeName] = $object->getProcessor();
		}
	}
	
	/**
	 * Returns a list of available object types.
	 * 
	 * @return	array<wcf\system\event\type\IEventType>
	 */
	public function getObjectTypes() {
		return $this->objectTypes;
	}	
	
	/**
	 * Returns objectType by given name
	 */
	public function getObjectType($objectType) {
		if (isset($this->objectTypes[$objectType])) {
			return $this->objectTypes[$objectType];
		}
		
		return null;
	}
}
