<?php
namespace gms\data\event;
use wcf\data\DatabaseObjectEditor;

/**
 * Editor for Event.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	data.event
 * @category	Guilded 2.0
 */
class EventEditor extends DatabaseObjectEditor {
	/**
	 * @see	wcf\data\DatabaseObjectDecorator::$baseClass
	 */
	protected static $baseClass = 'fms\data\event\Event';
}
