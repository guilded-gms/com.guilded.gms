<?php
namespace wcf\data\character\option\category;
use wcf\data\DatabaseObjectEditor;

/**
 * Provides functions to add, edit and delete character option categories.
 * 
 * @author	Jeffrey Reichardt
 * @copyright	2012-2013 DevLabor UG (haftungsbeschränkt)
 * @license	CC BY-NC-SA 3.0 <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.wcf.character
 * @subpackage	data.character.option.category
 * @category	Guilded 2.0
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
