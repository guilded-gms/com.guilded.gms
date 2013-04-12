<?php
namespace wcf\data\character;
use wcf\data\AbstractDatabaseObjectAction;
use wcf\system\database\util\PreparedStatementConditionBuilder;
use wcf\system\exception\PermissionDeniedException;
use wcf\system\exception\ValidateActionException;
use wcf\system\option\character\CharacterOptionHandler;
use wcf\system\WCF;
use wcf\util\StringUtil;

/**
 * Character-related actions
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2013 DevLabor UG (haftungsbeschränkt)
 * @license	CC BY-NC-SA 3.0 <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.wcf.character
 * @subpackage	data.character
 * @category	Guilded 2.0
*/
class CharacterAction extends AbstractDatabaseObjectAction {
	/**
	 * @see	wcf\data\AbstractDatabaseObjectAction::$className
	 */
	public $className = 'wcf\data\character\CharacterEditor';
	
	/**
	 * @see	wcf\data\AbstractDatabaseObjectAction::$permissionsCreate
	 */
	protected $permissionsCreate = array('user.character.canAddCharacter');
	
	/**
	 * @see	wcf\data\AbstractDatabaseObjectAction::$permissionsDelete
	 */
	protected $permissionsDelete = array('user.character.canDeleteCharacter');
	
	/**
	 * @see	wcf\data\AbstractDatabaseObjectAction::$permissionsUpdate
	 */
	protected $permissionsUpdate = array('user.character.canEditCharacter');
	
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
		// \todo
		//update all characters for games to isPrimary = 0
		//update this character
	}


	public function validateGetOptions() {	}

	/**
 	 * Gets all options for character.
 	 */
	public function getOptions() {
		$returnValues = array(
			'template' => ''
		);

		//build options
		$optionHandler = new CharacterOptionHandler($this->cacheName, $this->cacheClass, false, '', '', false);
		$options = $optionHandler->getOptionTree();

		// parse template
		WCF::getTPL()->assign(array(
			'options' => $options
		));
		$returnValues['template'] = WCF::getTPL()->fetch('characterOptions');

		return $returnValues;
	}
}
