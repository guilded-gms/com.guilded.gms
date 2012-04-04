<?php
namespace wcf\data\character;
use wcf\data\DatabaseObjectEditor;
use wcf\system\clipboard\ClipboardHandler;
use wcf\system\WCF;

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
