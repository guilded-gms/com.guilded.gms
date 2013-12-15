<?php
namespace gms\data\game\classification;
use wcf\data\DatabaseObjectList;

/**
 * Represents a list of game classes.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2013 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	data.game.class
 * @category	Guilded 2.0
 */
class GameClassificationList extends DatabaseObjectList {
	/**
	 * @see	\wcf\data\DatabaseObjectList::$className
	 */
	public $className = 'gms\data\game\classification\GameClassification';
}
