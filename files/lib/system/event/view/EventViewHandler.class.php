<?php
namespace gms\system\event\view;

class EventViewHandler extends SingleFactory {
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
		$this->objectTypes = ObjectTypeCache::getInstance()->getObjectTypes('com.guilded.gms.view');
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
	public static function getObjectTypeByName($typeName) {
		if (isset($this->objectTypes[$typeName])) {
			return $this->objectTypes[$typeName];
		}
		
		return null;
	}
}
