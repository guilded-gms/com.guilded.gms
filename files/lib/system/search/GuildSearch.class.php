<?php
namespace gms\system\search;
use gms\data\guild\SearchResultGuildList;
use wcf\system\search\AbstractSearchableObjectType;

/**
 * Guild search.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	system.search
 * @category	Guilded 2.0
 */
class GuildSearch extends AbstractSearchableObjectType {
	/**
	 * message data cache
	 * @var	array<\gms\data\guild\SearchResultGuild>
	 */
	public $messageCache = array();
	
	/**
	 * @see	\wcf\system\search\ISearchableObjectType::cacheObjects()
	 */
	public function cacheObjects(array $objectIDs, array $additionalData = null) {
		$guildList = new SearchResultGuildList();
		$guildList->getConditionBuilder()->add('guild.guildID IN (?)', array($objectIDs));
		$guildList->readObjects();

		foreach ($guildList->getObjects() as $guild) {
			$this->messageCache[$guild->guildID] = $guild;
		}
	}

	/**
	 * @see	\wcf\system\search\ISearchableObjectType::getObject()
	 */
	public function getObject($objectID) {
		if (isset($this->messageCache[$objectID])) {
			return $this->messageCache[$objectID];
		}

		return null;
	}
	
	/**
	 * @see	\wcf\system\search\ISearchableObjectType::getTableName()
	 */
	public function getTableName() {
		return 'wcf'.WCF_N.'_guild';
	}
	
	/**
	 * @see	\wcf\system\search\ISearchableObjectType::getIDFieldName()
	 */
	public function getIDFieldName() {
		return $this->getTableName().'.guildID';
	}
}
