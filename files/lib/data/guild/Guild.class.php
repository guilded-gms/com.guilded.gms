<?php
namespace wcf\data\guild;
use wcf\data\DatabaseObject;
use wcf\data\character\CharacterList;
use wcf\data\guild\recruitment\tender\GuildRecruitmentTenderList;
use wcf\system\api\rest\response\IRESTfulResponse;
use wcf\system\request\IRouteController;
use wcf\system\WCF;

class Guild extends DatabaseObject implements IRouteController, IRESTfulResponse {
	/**
	 * @see	wcf\data\DatabaseObject::$databaseTableName
	 */
	protected static $databaseTableName = 'guild';
	
	/**
	 * @see	wcf\data\DatabaseObject::$databaseTableIndexName
	 */
	protected static $databaseTableIndexName = 'guildID';

	/**
	 * List of guild members.
	 * @var	array<wcf\data\character\Character>
	 */
	protected $characters = array();
	
	/**
	 * List of guild tenders.
	 * @var	array<wcf\data\guild\recruitment\tender\GuildRecruitmentTender>
	 */
	protected $tenders = array();
	
	/**
	 * @see	wcf\system\request\IRouteController::getTitle()
	 */
	public function getTitle() {
		return $this->name;
	}
	
	/**
	 * Returns list of all guild members
	 *
	 * @return	array<wcf\data\character\Character>
	 */
	public function getCharacters() {
		if (empty($this->characters)) {
			$characterList = new CharacterList;
			$characterList->getConditionBuilder()->add('guildID = ?', array($this->guildID));
			$characterList->readObjects();
			
			$this->characters = $characterList->getObjects();
		}

		return $this->characters;
	}
	
	/**
	 * @see	wcf\data\DatabaseObject::handleData()
	 */
	protected function handleData($data) {
		parent::handleData($data);
		
		// add characters to data, so we can access them by RESTful-API
		$this->data['characters'] = $this->getCharacters();
	}
	
	/**
	 * Checks wether given character is a member of this guild.
	 *
	 * @param	integer	$characterID
	 * @return	boolean
	 */
	public function isMember($characterID) {		
		return isset($this->characters[$characterID]);
	}
	
	/**
	 * Returns list of all tenders.
	 *
	 * @return	array<wcf\data\guild\recruitment\tender\GuildRecruitmentTender>
	 */
	public function getTenders() {
		if (empty($this->tenders)) {
			$recruitmentTenderList = new GuildRecruitmentTenderList();
			$recruitmentTenderList->getConditionBuilder()->add('guildID = ?', array($this->guildID));
			$recruitmentTenderList->readObjects();
			
			$this->tenders = $recruitmentTenderList->getObjects();
		}
		
		return $this->tenders;
	}	

	/**
	 * @see	IRESTfulResponse::getResponseFields()
	 */
	public function getResponseFields() {
		return array_keys($this->data);
	}	
}
