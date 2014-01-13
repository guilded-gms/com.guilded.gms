x+)JMU011d040031QpO�M�K�I,.�+�(`���%v�o��g��)��uz��q
I�kJfI~�����Uo+Y�����׺��η�H�}2�K�T��s���������l;m/٬�51 �2�2�K2���7�)z~��MW�,SvY!I�Ǯ�
�s�K�JJ��mz�6&�������"5i��`S=
�>�޷d����`X��}���y�@3�SV��Ӽx�a��'*v��7_-�*)I�eН�wό
�/��޺>��ݽ"]���T��fu��
9'�^̓���*����p�J�sY�����'T'�-~���.N-*K-b�?�arI����)�<W��D�QP���
�㭿���~?�1�W���m���E +;�n                                                                                                                          age	data.guild
 * @category	Guilded 2.0
 */
class GuildAction extends AbstractDatabaseObjectAction implements IToggleAction {
	/**
	 * @see	\wcf\data\AbstractDatabaseObjectAction::$className
	 */
	public $className = 'gms\data\guild\GuildEditor';
	
	/**
	 * @see	\wcf\data\AbstractDatabaseObjectAction::$permissionsCreate
	 */
	protected $permissionsCreate = array('admin.gms.guild.canManage');
	
	/**
	 * @see	\wcf\data\AbstractDatabaseObjectAction::$permissionsDelete
	 */
	protected $permissionsDelete = array('admin.gms.guild.canManage');
	
	/**
	 * @see	\wcf\data\AbstractDatabaseObjectAction::$permissionsUpdate
	 */
	protected $permissionsUpdate = array('admin.gms.guild.canManage');

	/**
	 * Validates permissions and parameters
	 */
	public function validateToggle() {
		parent::validateUpdate();
	}

	/**
	 * Toggles status.
	 */
	public function toggle() {
		if (empty($this->objects)) {
			$this->readObjects();
		}

		foreach ($this->objects as $object) {
			$object->update(array(
				'isPublic' => ($object->isPublic - 1)
			));
		}
	}

	/**
	 * Validates parameters to search for guilds and -groups.
	 */
	public function validateGetList() {
		if (!isset($this->parameters['data']['searchString'])) {
			throw new ValidateActionException("Missing parameter 'searchString'");
		}
		
		if (!isset($this->parameters['data']['includeGuildGroups'])) {
			throw new ValidateActionException("Missing parameter 'includeGuildGroups'");
		}
		
		if (isset($this->parameters['data']['excludedSearchValues']) && !is_array($this->parameters['data']['excludedSearchValues'])) {
			throw new ValidateActionException("Invalid parameter 'excludedSearchValues' given");
		}
	}
	
	/**
	 * Returns a list of guilds and -groups based upon given search criteria.
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
	
		if ($this->parameters['data']['includeGuildGroups']) {
			$accessibleGroups = GuildGroup::getAccessibleGroups();
			foreach ($accessibleGroups as $group) {
				$groupName = $group->getName();
				if (!in_array($groupName, $excludedSearchValues)) {
					$pos = mb_stripos($groupName, $searchString);
					if ($pos !== false && $pos == 0) {
						$list[] = array(
							'label' => $groupName,
							'objectID' => $group->groupID,
							'type' => 'group'
						);
					}
				}
			}
		}
		
		$conditionBuilder = new PreparedStatementConditionBuilder();
		$conditionBuilder->add("name LIKE ?", array($searchString.'%'));
		if (count($excludedSearchValues)) {
			$conditionBuilder->add("name NOT IN (?)", array($excludedSearchValues));
		}
	
		// find guilds
		$sql = "SELECT	guildID, name
				FROM	".Guild::getDatabaseTableName()."
			".$conditionBuilder;
		$statement = WCF::getDB()->prepareStatement($sql);
		$statement->execute($conditionBuilder->getParameters());
		while ($row = $statement->fetchArray()) {
			$list[] = array(
				'label' => $row['name'],
				'objectID' => $row['guildID'],
				'type' => 'guild'
			);
		}
	
		return $list;
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
				$objects[$object->getObjectID()] = $provider->getGuild($object->getDecoratedObject()->server, $object->getDecoratedObject()->name);
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
}
