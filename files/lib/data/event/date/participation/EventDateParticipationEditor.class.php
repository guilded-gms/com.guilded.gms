<?php
namespace gms\data\event\date\participation;
use wcf\data\DatabaseObjectEditor;

/**
 * Editor for event participation.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	CC BY-NC-SA 3.0 <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	data.event.date.participation
 * @category	Guilded 2.0
 */
class EventDateParticipationEditor extends DatabaseObjectEditor {
	/**
	 * @see	wcf\data\DatabaseObjectDecorator::$baseClass
	 */
	protected static $baseClass = 'gms\data\event\date\participation\EventParticipation';
}
