<?php
namespace gms\system\game\provider;
use wcf\data\object\type\ObjectTypeCache;
use wcf\system\SingletonFactory;

/**
 * Handles available game providers.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	system.game.provider
 * @category	Guilded 2.0
*/
class GameProviderHandler extends SingletonFactory {
	/**
	 * cached object types
	 * @var	array<array>
	 */
	protected $cache = null;
	
	/**
	 * @see	\wcf\system\SingletonFactory::init()
	 */
	protected function init() {
		// load cache
		$this->cache = ObjectTypeCache::getInstance()->getObjectTypes('com.guilded.gms.provider');
	}
	
	/**
	 * Returns an object type from cache.
	 *
	 * @param	string	$objectName
	 * @return	\wcf\data\object\type\ObjectType|null
	 */
	public function getObjectType($objectName) {
		if (isset($this->cache[$objectName])) {
			return $this->cache[$objectName];
		}
		
		return null;
	}
}
