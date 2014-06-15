<?php
namespace gms\data\character;
use gms\system\character\activity\CharacterActivityHandler;
use gms\system\character\CharacterHandler;
use wcf\data\AbstractDatabaseObjectAction;
use wcf\system\database\util\PreparedStatementConditionBuilder;
use wcf\system\exception\PermissionDeniedException;
use wcf\system\exception\ValidateActionException;
use wcf\system\WCF;

/**
 * Character-related actions
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
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
	protected $permissionsCreate = array('user.gms.character.canManage');

	/**
	 * @see	\wcf\data\AbstractDatabaseObjectAction::$permissionsDelete
	 */
	protected $permissionsDelete = array('user.gms.character.canManage');

	/**
	 * @see	\wcf\data\AbstractDatabaseObjectAction::$permissionsUpdate
	 */
	protected $permissionsUpdate = array('user.gms.character.canManage');

	/**
	 * @see	\wcf\data\AbstractDatabaseObjectAction::create()
	 */
	public function create() {
		$character = parent::create();
		$characterEditor = new CharacterEditor($character);

		// updates user options
		if (isset($this->parameters['options'])) {
			$characterEditor->updateOptions($this->parameters['options']);
		}

		return $character;
	}

	/**
	 * @see	\wcf\data\AbstractDatabaseObjectAction::update()
	 */
	public function update() {
		parent::update();

		$options = (isset($this->parameters['options'])) ? $this->parameters['options'] : array();

		foreach ($this->objects as $objectEditor) {
			if (!empty($options)) {
				$objectEditor->updateOptions($options);
			}
		}
	}

	/**
	 * @see	\wcf\data\AbstractDatabaseObjectAction::validateUpdate()
	 */
	public function validateUpdate() {
		parent::validateUpdate();

		foreach ($this->objects as $objectEditor) {
			if ($objectEditor->userID != WCF::getUser()->userID && !WCF::getSession()->getPermission('mod.gms.character.canManage')) {
				throw new PermissionDeniedException();
			}
		}
	}

	/**
	 * @see	\wcf\data\AbstractDatabaseObjectAction::validateDelete()
	 */
	public function validateDelete() {
		parent::validateDelete();

		foreach ($this->objects as $objectEditor) {
			if ($objectEditor->userID != WCF::getUser()->userID || !WCF::getSession()->getPermission('mod.gms.character.canManage')) {
				throw new PermissionDeniedException();
			}
		}
	}

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
			FROM	".Character::getDatabaseTableName()."
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
		$this->validateUpdate();
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
		$this->validateUpdate();
	}

	/**
	 * Gets data from provider.
	 *
	 * @return	array
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
		$this->validateUpdate();
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
		$this->validateUpdate();
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

			// create character activity
			CharacterActivityHandler::getInstance()->fireEvent('gms.character.event.guild.join', $objectEditor->characterID, $objectEditor->getDecoratedObject());

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

			// write activity
			CharacterActivityHandler::getInstance()->fireEvent('gms.character.event.guild.leave', $objectEditor->characterID, $objectEditor->getDecoratedObject());

			// save affected objectIDs
			$objectIDs[] = $objectEditor->characterID;
		}

		return array(
			'objectIDs' => $objectIDs
		);
	}
}
