<?php
namespace wcf\data\character\group;
use wcf\data\DatabaseObject;
use wcf\system\api\rest\response\IRESTfulResponse;
use wcf\system\WCF;

class CharacterGroup extends DatabaseObject implements IRESTfulResponse {
	/**
	 * @see	wcf\data\DatabaseObject::$databaseTableName
	 */
	protected static $databaseTableName = 'character_group';
	
	/**
	 * @see	wcf\data\DatabaseObject::$databaseTableIndexName
	 */
	protected static $databaseTableIndexName = 'groupID';
		
	/**
	 * @see	IRESTfulResponse::getResponseFields()
	 */
	public function getResponseFields() {
		return array_keys(array_merge($this->data, array('characters')));
	}
}
