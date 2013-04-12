<?php
namespace wcf\data\character\option\category;
use wcf\data\AbstractDatabaseObjectAction;

/**
 * Executes character option category-related actions.
 * 
 * @author	Jeffrey Reichardt
 * @copyright	2012-2013 DevLabor UG (haftungsbeschränkt)
 * @license	CC BY-NC-SA 3.0 <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.wcf.character
 * @subpackage	data.character.option.category
 * @category	Guilded 2.0
 */
class CharacterOptionCategoryAction extends AbstractDatabaseObjectAction {
	/**
	 * @see	wcf\data\AbstractDatabaseObjectAction::$className
	 */
	protected $className = 'wcf\data\character\option\category\CharacterOptionCategoryEditor';
}
