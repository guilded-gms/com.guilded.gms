<?php
namespace wcf\data\character\option\category;
use wcf\data\DatabaseObjectEditor;

/**
 * Provides functions to add, edit and delete character option categories.
 */
class CharacterOptionCategoryEditor extends DatabaseObjectEditor {
	/**
	 * @see	wcf\data\character\option\category\CharacterOptionCategory::$baseClass
	 */
	protected static $baseClass = 'wcf\data\character\option\category\CharacterOptionCategory';
	
	/**
	 * @see	wcf\data\IEditableObject::create()
	 */
	public static function create(array $parameters = array()) {
		// obtain default values
		if (!isset($parameters['packageID'])) $parameters['packageID'] = PACKAGE_ID;
		
		return parent::create($parameters);
	}
}
