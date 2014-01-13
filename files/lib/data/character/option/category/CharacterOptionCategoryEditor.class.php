<?php
namespace gms\data\character\option\category;
use wcf\data\DatabaseObjectEditor;

/**
 * Provides functions to add, edit and delete character option categories.
 * 
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	data.character.option.category
 * @category	Guilded 2.0
 */
class CharacterOptionCategoryEditor extends DatabaseObjectEditor {
	/**
	 * @see	\gms\data\character\option\category\CharacterOptionCategory::$baseClass
	 */
	protected static $baseClass = 'gms\data\character\option\category\CharacterOptionCategory';
	
	/**
	 * @see	\wcf\data\IEditableObject::create()
	 */
	public static function create(array $parameters = array()) {
		// obtain default values
		if (!isset($parameters['packageID'])) $parameters['packageID'] = PACKAGE_ID;
		
		return parent::create($parameters);
	}
}
