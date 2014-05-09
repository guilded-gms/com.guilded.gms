<?php
namespace gms\data;
use wcf\data\DatabaseObject;

/**
 * Application-related implementation of database object.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	data
 * @category	Guilded 2.0
 */
abstract class GMSDatabaseObject extends DatabaseObject {
	/**
	 * @see	\wcf\data\IStorableObject::getDatabaseTableName()
	 */
	public static function getDatabaseTableName() {
		return 'gms'.WCF_N.'_'.static::$databaseTableName;
	}
}
