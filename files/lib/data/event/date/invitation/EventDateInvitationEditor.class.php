<?php
namespace gms\data\event\date\invitation;
use wcf\data\DatabaseObjectEditor;
use wcf\system\WCF;

/**
 * 
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	CC BY-NC-SA 3.0 <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	data.event.date.invitation
 * @category	Guilded 2.0
 */
class EventDateInvitationEditor extends DatabaseObjectEditor {
	/**
	 * @see	\wcf\data\DatabaseObjectDecorator::$baseClass
	 */
	protected static $baseClass = 'gms\data\event\date\invitation\EventDateInvitation';
}
