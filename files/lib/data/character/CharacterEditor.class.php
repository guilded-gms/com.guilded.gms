<?php
namespace gms\data\character;
use wcf\data\DatabaseObjectEditor;
use wcf\system\clipboard\ClipboardHandler;
use wcf\system\WCF;

/**
 * The character editor
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	data.character
 * @category	Guilded 2.0
 */
class CharacterEditor extends DatabaseObjectEditor {
	/**
	 * @see	\wcf\data\DatabaseObjectDecorator::$baseClass
	 */
	protected static $baseClass = 'gms\data\character\Character';

	/**
	 * @see	\wcf\data\IEditableObject::create()
	 */
	public static function create(array $parameters = array()) {
		$character = parent::create($parameters);

		// create default values for user options
		self::createDefaultOptions($character->characterID);

		return $character;
	}

	/**
	 * Inserts default options.
	 *
	 * @param	integer		$characterID
	 */
	protected static function createDefaultOptions($characterID) {
		// fetch default values
		$sql = "SELECT	optionID, defaultValue
				FROM	gms".WCF_N."_character_option";
		$statement = WCF::getDB()->prepareStatement($sql);
		$statement->execute();

		WCF::getDB()->beginTransaction();

		while ($row = $statement->fetchArray()) {
			if (!empty($row['defaultValue'])) {
				$sql = "INSERT INTO	gms".WCF_N."_character_option_value (characterID, optionID, optionValue)
						VALUES (?, ?, ?)";
				$statement = WCF::getDB()->prepareStatement($sql);
				$statement->execute(array($characterID, $row['optionID'], $row['defaultValue']));
			}
		}

		WCF::getDB()->commitTransaction();
	}

	/**
	 * Updates character options.
	 *
	 * @param	array		$options
	 */
	public function updateOptions(array $options = array()) {
		WCF::getDB()->beginTransaction();

		foreach ($options as $optionID => $optionValue) {
			$sql = "INSERT IGNORE INTO gms".WCF_N."_character_option_value(optionValue, characterID, optionID)
					VALUES (?, ?, ?)";
			$statement = WCF::getDB()->prepareStatement($sql);
			$statement->execute(array($optionValue, $this->characterID, $optionID));
		}

		WCF::getDB()->commitTransaction();
	}

	/**
	 * @see	\wcf\data\IEditableObject::deleteAll()
	 */
	public static function deleteAll(array $objectIDs = array()) {
		// unmark users
		ClipboardHandler::getInstance()->unmark($objectIDs, ClipboardHandler::getInstance()->getObjectTypeID('com.guilded.gms.character'));
	
		return parent::deleteAll($objectIDs);
	}

	/**
	 * Sets character as primary for specific game.
	 */
	public function setAsPrimary() {
		//update all characters for games to isPrimary = 0
		$sql = "UPDATE	".static::getDatabaseTableName()."
				SET		isPrimary = 0
				WHERE	gameID = ?";
		$statement = WCF::getDB()->prepareStatement($sql);
		$statement->execute(array($this->gameID));

		//update this character
		$this->update(array(
			'isPrimary' => 1
		));
	}
}
