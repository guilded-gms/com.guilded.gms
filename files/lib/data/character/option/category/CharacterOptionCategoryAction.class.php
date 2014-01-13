<?php
namespace gms\data\character\option\category;
use wcf\data\AbstractDatabaseObjectAction;

/**
 * Executes character option category-related actions.
 * 
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	data.character.option.category
 * @category	Guilded 2.0
 */
class CharacterOptionCategoryAction extends AbstractDatabaseObjectAction {
	/**
	 * @see	\wcf\data\AbstractDatabaseObjectAction::$className
	 */
	protected $className = 'gms\data\character\option\category\CharacterOptionCategoryEditor';
}
