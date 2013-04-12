<?php
namespace wcf\data\character;
use wcf\data\DatabaseObjectEditor;
use wcf\system\clipboard\ClipboardHandler;
use wcf\system\WCF;

/**
 * The character editor
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2013 DevLabor UG (haftungsbeschränkt)
 * @license	CC BY-NC-SA 3.0 <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.wcf.character
 * @subpackage	data.character
 * @category	Guilded 2.0
*/
class CharacterEditor extends DatabaseObjectEditor {
	/**
	 * @see	wcf\data\DatabaseObjectDecorator::$baseClass
	 */
	protected static $baseClass = 'wcf\data\character\Character';
	
	/**
	 * @see	wcf\data\IEditableObject::deleteAll()
	 */
	public static function deleteAll(array $objectIDs = array()) {
		// unmark users
		ClipboardHandler::getInstance()->unmark($objectIDs, ClipboardHandler::getInstance()->getObjectTypeID('com.guilded.wcf.character'));
	
		return parent::deleteAll($objectIDs);
	}
}
