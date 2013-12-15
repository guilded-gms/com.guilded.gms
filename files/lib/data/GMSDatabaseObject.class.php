<?php
namespace gms\data;
use wcf\data\DatabaseObject;

abstract class GMSDatabaseObject extends DatabaseObject {
	/**
	 * @see	\wcf\data\IStorableObject::getDatabaseTableName()
	 */
	public static function getDatabaseTableName() {
		return 'gms'.WCF_N.'_'.static::$databaseTableName;
	}
}
