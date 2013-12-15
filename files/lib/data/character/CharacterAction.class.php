<?php
namespace gms\data\character;
use wcf\data\AbstractDatabaseObjectAction;
use wcf\system\database\util\PreparedStatementConditionBuilder;
use wcf\system\exception\ValidateActionException;
use wcf\system\WCF;

/**
 * Character-related actions
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2013 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	data.character
 * @category	Guilded 2.0
 */
class CharacterAction extends AbstractDatabaseObjectAction {
	/**
	 * @see	\wcf\data\AbstractDatabaseObjectAction::$className
	 */
	public $className = 'gms\data\character\CharacterEditor';
	
	/**
	 * @see	\wcf\data\AbstractDatabaseObjectAction::$permissionsCreate
	 */
	protected $permissionsCreate = array('user.character.canManageCharacter');
	
	/**
	 * @see	\wcf\data\AbstractDatabaseObjectAction::$permissionsDelete
	 */
	protected $permissionsDelete = array('user.character.canManageCharacter');
	
	/**
	 * @see	\wcf\data\AbstractDatabaseObjectAction::$permissionsUpdate
	 */
	protected $permissionsUpdate = array('user.character.canManageCharacter');
	
	/**
	 * Validates parameters to search for characters and -groups.
	 */
	public function validateGetList() {
		if (!isset($this->parameters['data']['searchString'])) {
			throw new ValidateActionException("Missing parameter 'searchString'");
		}
		
		if (!isset($this->parameters['data']['includeCharacterGroups'])) {
			throw new ValidateActionException("Missing parameter 'includeCharacterGroups'");
		}
		
		if (isset($this->parameters['data']['excludedSearchValues']) && !is_array($this->parameters['data']['excludedSearchValues'])) {
			throw new ValidateActionException("Invalid parameter 'excludedSearchValues' given");
		}
	}
	
	/**
	 * Returns a list of characters and -groups based upon given search criteria.
	 * 
	 * @return	array<array>
	 */
	public function getList() {
		$searchString = $this->parameters['data']['searchString'];
		$excludedSearchValues = array();
		if (isset($this->parameters['data']['excludedSearchValues'])) {
			$excludedSearchValues = $this->parameters['data']['excludedSearchValues'];
		}
		$list = array();
		
		$conditionBuilder = new PreparedStatementConditionBuilder();
		$conditionBuilder->add("name LIKE ?", array($searchString.'%'));
		if (count($excludedSearchValues)) {
			$conditionBuilder->add("name NOT IN (?)", array($excludedSearchValues));
		}
	
		// find characters
		$sql = "SELECT	characterID, name
			FROM	wcf".WCF_N."_character
			".$conditionBuilder;
		$statement = WCF::getDB()->prepareStatement($sql);
		$statement->execute($conditionBuilder->getParameters());

		while ($row = $statement->fetchArray()) {
			$list[] = array(
				'label' => $row['name'],
				'objectID' => $row['characterID'],
				'type' => 'character'
			);
		}
	
		return $list;
	}
	
	/**
	 * Validates execution of setting character as primary.
	 */
	public function validateSetPrimary() {
		parent::validateUpdate();
	}
	
	/**
	 * Sets character as primary character.
	 */
	public function setPrimary() {
		if (empty($this->objects)) {
			$this->readObjects();
		}

		foreach ($this->objects as $characterEditor) {
			$characterEditor->setAsPrimary();
		}
	}

	/**
	 * Validates getProviderData.
	 */
	public function validateGetProviderData() {
		parent::validateUpdate();
	}

	/**
	 * Gets data from provider.
	 */
	public function getProviderData() {
		if (empty($this->objects)) {
			$this->readObjects();
		}

		$objects = array();

		foreach ($this->objects as $object) {
			$provider = $object->getDecoratedObject()->getGame()->getProvider();
			if ($provider !== null) {
				$objects[$object->getObjectID()] = $provider->getCharacter($object->getDecoratedObject()->getGuild()->server, $object->getDecoratedObject()->name);
			}
		}

		return array(
			'objects' => $objects
		);
	}

	/**
	 * Validates synchronization.
	 */
	public function validateSynchronize() {
		parent::validateUpdate();
	}

	/**
	 * Synchronizes data between provider and current data.
	 *
	 * @return	array
	 */
	public function synchronize() {
		list($objects) = $this->getProviderData();

		$objectIDs = array();
		foreach ($this->objects as $object) {
			if (isset($objects[$object->getObjectID()])) {
				$updateData = array();

				// check internal and external data, update if required
				foreach ($objects[$object->getObjectID()] as $key => $value) {
					if (!isset($object->$key)) {
						continue;
					}

					if ($object->$key != $value) {
						$updateData[$key] = $value;
					}
				}

				// update object with new data
				$object->update(array($updateData));

				// save affected objectIDs
				$objectIDs[] = $object->getObjectID();
			}
		}

		return array(
			'objectIDs' => $objectIDs
		);
	}

	/**
	 * Validates guild assign.
	 */
	public function validateAssignToGuild() {
		parent::update();
	}

	/**
	 * Assigns Characters to guild.
	 *
	 * @return	array
	 */
	public function assignToGuild() {
		$this->readInteger('guildID', false, 'data');

		if (empty($this->objects)) {
			$this->readObjects();
		}

		$objectIDs = array();
		foreach ($this->objects as $objectEditor) {
			$objectEditor->update(array(
				'guildID' => $this->parameters['data']['guildID']
			));

			// @todo write activity (character/guild)

			// save affected objectIDs
			$objectIDs[] = $objectEditor->characterID;
		}

		return array(
			'objectIDs' => $objectIDs
		);
	}

	/**
	 * Validates guild leave.
	 */
	public function validateRemoveFromGuild() {
		parent::update();
	}

	/**
	 * Leaves guild.
	 *
	 * @return	array
	 */
	public function removeFromGuild() {
		if (empty($this->objects)) {
			$this->readObjects();
		}

		$objectIDs = array();
		foreach ($this->objects as $objectEditor) {
			$objectEditor->update(array(
				'guildID' => null
			));

			// @todo write activity (character/guild)

			// save affected objectIDs
			$objectIDs[] = $objectEditor->characterID;
		}

		return array(
			'objectIDs' => $objectIDs
		);
	}
}
