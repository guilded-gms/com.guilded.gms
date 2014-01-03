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
	 * @see	\wcf\data\IEditableObject::deleteAll()
	 */
	public static function deleteAll(array $objectIDs = array()) {
		// unmark users
		ClipboardHandler::getInstance()->unmark($objectIDs, ClipboardHandler::getInstance()->getObjectTypeID('com.guilded.gms'));
	
		return parent::deleteAll($objectIDs);
	}

	/**
	 * Sets character as primary for specific game.
	 */
	public function setAsPrimary() {
		//update all characters for games to isPrimary = 0
		$sql = "UPDATE	".static::getDatabaseTableName()."
				SET isPrimary = 0
				WHERE (gameID = ?)";
		$statement = WCF::getDB()->prepareStatement($sql);
		$statement->execute(array($this->gameID));

		//update this character
		$this->update(array('isPrimary' => 1));
	}
}
