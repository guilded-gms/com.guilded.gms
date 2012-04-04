<?php
namespace wcf\data\character;
use wcf\data\AbstractDatabaseObjectAction;
use wcf\system\database\util\PreparedStatementConditionBuilder;
use wcf\system\exception\PermissionDeniedException;
use wcf\system\exception\ValidateActionException;
use wcf\system\WCF;
use wcf\util\StringUtil;

class CharacterAction extends AbstractDatabaseObjectAction {
	/**
	 * @see	wcf\data\AbstractDatabaseObjectAction::$className
	 */
	public $className = 'wcf\data\character\CharacterEditor';
	
	/**
	 * @see	wcf\data\AbstractDatabaseObjectAction::$permissionsCreate
	 */
	protected $permissionsCreate = array('admin.user.canAddUser');
	
	/**
	 * @see	wcf\data\AbstractDatabaseObjectAction::$permissionsDelete
	 */
	protected $permissionsDelete = array('admin.user.canDeleteUser');
	
	/**
	 * @see	wcf\data\AbstractDatabaseObjectAction::$permissionsUpdate
	 */
	protected $permissionsUpdate = array('admin.user.canEditUser');
	
	/**
	 * Validates parameters to search for users and -groups.
	 */
	public function validateGetList() {
		if (!isset($this->parameters['data']['searchString'])) {
			throw new ValidateActionException("Missing parameter 'searchString'");
		}
		
		if (!isset($this->parameters['data']['includeUserGroups'])) {
			throw new ValidateActionException("Missing parameter 'includeUserGroups'");
		}
		
		if (isset($this->parameters['data']['excludedSearchValues']) && !is_array($this->parameters['data']['excludedSearchValues'])) {
			throw new ValidateActionException("Invalid parameter 'excludedSearchValues' given");
		}
	}
	
	/**
	 * Returns a list of users and -groups based upon given search criteria.
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
	
		if ($this->parameters['data']['includeUserGroups']) {
			$accessibleGroups = UserGroup::getAccessibleGroups();
			foreach ($accessibleGroups as $group) {
				$groupName = $group->getName();
				if (!in_array($groupName, $excludedSearchValues)) {
					$pos = StringUtil::indexOfIgnoreCase($groupName, $searchString);
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
		$conditionBuilder->add("username LIKE ?", array($searchString.'%'));
		if (count($excludedSearchValues)) {
			$conditionBuilder->add("username NOT IN (?)", array($excludedSearchValues));
		}
	
		// find users
		$sql = "SELECT	userID, username
			FROM	wcf".WCF_N."_user
			".$conditionBuilder;
		$statement = WCF::getDB()->prepareStatement($sql);
		$statement->execute($conditionBuilder->getParameters());
		while ($row = $statement->fetchArray()) {
			$list[] = array(
				'label' => $row['username'],
				'objectID' => $row['userID'],
				'type' => 'user'
			);
		}
	
		return $list;
	}
}
