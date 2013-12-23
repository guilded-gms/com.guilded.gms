<?php
namespace gms\data\guild\option\category;
use wcf\data\DatabaseObjectEditor;

/**
 * Provides functions to add, edit and delete guild option categories.
 */
class GuildOptionCategoryEditor extends DatabaseObjectEditor {
	/**
	 * @see	\gms\data\guild\option\category\GuildOptionCategory::$baseClass
	 */
	protected static $baseClass = 'gms\data\guild\option\category\GuildOptionCategory';
	
	/**
	 * @see	\wcf\data\IEditableObject::create()
	 */
	public static function create(array $parameters = array()) {
		// obtain default values
		if (!isset($parameters['packageID'])) $parameters['packageID'] = PACKAGE_ID;
		
		return parent::create($parameters);
	}
}
