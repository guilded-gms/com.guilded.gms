<?php
namespace gms\data\game\classification;
use wcf\data\AbstractDatabaseObjectAction;

/**
 * Class-related actions
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	data.game.class
 * @category	Guilded 2.0
 */
class GameClassificationAction extends AbstractDatabaseObjectAction {
	/**
	 * @see	\wcf\data\AbstractDatabaseObjectAction::$className
	 */
	protected $className = 'gms\data\game\classification\GameClassificationEditor';
}
