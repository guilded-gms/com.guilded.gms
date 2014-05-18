<?php
namespace gms\data\event\date\participation;
use gms\data\GMSDatabaseObject;

/**
 * Represents an event date participation.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	CC BY-NC-SA 3.0 <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	data.event.date.participation
 * @category	Guilded 2.0
 */
class EventDateParticipation extends GMSDatabaseObject {
	const STATUS_YES = 1;
	const STATUS_MAYBE = 2;
	const STATUS_NO = 3;

	/**
	 * @see	wcf\data\DatabaseObject::$databaseTableName
	 */
	protected static $databaseTableName = 'event_date_participation';
	
	/**
	 * @see	wcf\data\DatabaseObject::$databaseTableIndexName
	 */
	protected static $databaseTableIndexName = 'participationID';
}
