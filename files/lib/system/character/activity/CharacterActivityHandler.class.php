<?php
namespace gms\system\character\activity;
use gms\data\character\activity\CharacterActivityEditor;
use gms\data\character\activity\CharacterActivityList;
use wcf\system\SingletonFactory;

/**
 * Handles character activities.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	system.character.activity
 * @category	Guilded 2.0
 */
class CharacterActivityHandler extends SingletonFactory {
	/**
	 * cached activities
	 * @var    array
	 */
	protected $cache = array();

	/**
	 * Creates a new character activity.
	 *
	 * @param	string						$languageItemName
	 * @param	integer						$characterID
	 * @param	\wcf\data\DatabaseObject	$object
	 */
	public function fireEvent($languageItemName, $characterID, $object)	{
		CharacterActivityEditor::create(array(
			'time' => TIME_NOW,
			'languageItemName' => $languageItemName,
			'characterID' => $characterID,
			'additionalData' => serialize(array('object' => $object))
		));
	}

	/**
	 * Returns a list of activities.
	 *
	 * @param	integer	$characterID
	 * @return	array
	 */
	public function getActivities($characterID) {
		if (!isset($this->cache[$characterID])) {
			$activityList = new CharacterActivityList();
			$activityList->getConditionBuilder()->add('characterID = ?', array($characterID));
			$activityList->readObjects();

			$this->cache[$characterID] = $activityList->getObjects();
		}

		return $this->cache[$characterID];
	}
}
