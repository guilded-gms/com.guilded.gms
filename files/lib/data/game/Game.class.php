<?php
namespace gms\data\game;
use gms\data\game\classification\GameClassificationList;
use gms\data\game\faction\GameFactionList;
use gms\data\game\instance\GameInstanceList;
use gms\data\game\item\GameItemList;
use gms\data\game\race\GameRaceList;
use gms\data\game\role\GameRoleList;
use gms\data\GMSDatabaseObject;
use wcf\system\game\provider\GameProviderHandler;
use wcf\system\request\IRouteController;
use wcf\system\style\StyleHandler;
use wcf\system\WCF;
use wcf\util\StringUtil;

/**
 * Represents a game.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2013 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	data.game
 * @category	Guilded 2.0
 */
class Game extends GMSDatabaseObject implements IRouteController {
	/**
	 * @see	\wcf\data\DatabaseObject::$databaseTableName
	 */
	protected static $databaseTableName = 'game';
	
	/**
	 * @see	\wcf\data\DatabaseObject::$databaseTableIndexName
	 */
	protected static $databaseTableIndexName = 'gameID';

	protected $factionList = null;
	protected $raceList = null;
	protected $classList = null;
	protected $roleList = null;
	protected $instanceList = null;
	protected $itemList = null;

	/**
	 * Returns title of game.
	 *
	 * @return	string
	 */
	public function getTitle() {
		return WCF::getLanguage()->get('gms.game.' . $this->title . '.title');
	}

	/**
	 * Returns object of provider.
	 *
	 * @return	\wcf\system\game\provider\GameProvider
	 */
	public function getProvider() {
		return GameProviderHandler::getInstance()->getObjectType('com.guilded.gms.provider.' . mb_strtolower($this->title));
	}

	/**
	 * Returns full path to icon.
	 *
	 * @param	string	$size
	 * @return	string
	 */
	public function getIcon($size = 'medium') {
		$size = mb_strtoupper(mb_substr($size, 0, 1));

		$filePath = 'icon/' . $this->title . '/' . $this->icon . $size . '.png';
		if (!file_exists(WCF_DIR . $filePath)) {
			return '';
		}

		return WCF::getPath() . $filePath;
	}

	/**
	 * Returns a list of available factions.
	 *
	 * @return	\gms\data\game\faction\GameFactionList
	 */
	public function getFactionList() {
		if ($this->factionList === null) {
			$this->factionList = new GameFactionList();
			$this->factionList->getConditionBuilder()->add('gameID = ?', array($this->gameID));
			$this->factionList->readObjects();
		}
		
		return $this->factionList;
	}

	/**
	 * Returns list of factions.
	 *
	 * @return	array
	 */
	public function getFactions() {
		return $this->getFactionList()->getObjects();
	}
	
	/**
	 * Returns a list of available races.
	 *
	 * @return	\gms\data\game\race\GameRaceList
	 */
	public function getRaceList() {
		if ($this->raceList === null) {
			$this->raceList = new GameRaceList();
			$this->raceList->getConditionBuilder()->add('gameID = ?', array($this->gameID));
			$this->raceList->readObjects();
		}
		
		return $this->raceList;
	}

	/**
	 * Returns list of races.
	 *
	 * @return	array
	 */
	public function getRaces() {
		return $this->getRaceList()->getObjects();
	}
	
	/**
	 * Returns a list of available classes.
	 *
	 * @return	\gms\data\game\class\GameClassificationList
	 */
	public function getClassList() {
		if ($this->classList === null) {
			$this->classList = new GameClassificationList();
			$this->classList->getConditionBuilder()->add('gameID = ?', array($this->gameID));
			$this->classList->readObjects();
		}
		
		return $this->classList;
	}

	/**
	 * Returns list of class.
	 *
	 * @return	array
	 */
	public function getClasses() {
		return $this->getClassList()->getObjects();
	}

	/**
	 * Returns a list of available roles.
	 *
	 * @return	\gms\data\game\role\GameRoleList
	 */
	public function getRoleList() {
		if ($this->roleList === null) {
			$this->roleList = new GameRoleList();
			$this->roleList->getConditionBuilder()->add('gameID = ?', array($this->gameID));
			$this->roleList->readObjects();
		}
		
		return $this->roleList;
	}

	/**
	 * Returns list of roles.
	 *
	 * @return	array
	 */
	public function getRoles() {
		return $this->getRoleList()->getObjects();
	}
	
	/**
	 * Returns a list of available roles.
	 *
	 * @return	\gms\data\game\instance\GameInstanceList
	 */
	public function getInstanceList() {
		if ($this->instanceList === null) {
			$this->instanceList = new GameInstanceList();
			$this->instanceList->getConditionBuilder()->add('gameID = ?', array($this->gameID));
			$this->instanceList->readObjects();
		}
		
		return $this->instanceList;
	}

	/**
	 * Returns list of instances.
	 *
	 * @return	array
	 */
	public function getInstances() {
		return $this->getInstanceList()->getObjects();
	}

	/**
	 * Returns a list of available roles.
	 *
	 * @return	\gms\data\game\instance\GameInstanceList
	 */
	public function getItemList() {
		if ($this->itemList === null) {
			$this->itemList = new GameItemList();
			$this->itemList->getConditionBuilder()->add('gameID = ?', array($this->gameID));
			$this->itemList->readObjects();
		}
		
		return $this->itemList;
	}

	/**
	 * Returns list of items.
	 *
	 * @return	array
	 */
	public function getItems() {
		return $this->getItemList()->getObjects();
	}

	/**
	 * Returns the html code to display the icon.
	 *
	 * @param	integer		$size
	 * @return	string
	 */
	public function getImageTag($size = 48) {
		//return '<img src="' . WCF::getPath().'icon/'.$this->icon . '" style="width: '.$size.'px; height: '.$size.'px" alt="' . $this->getTitle() . '" />'; // @todo
		return '<img src="/wowB.png" style="width: '.$size.'px; height: '.$size.'px" alt="' . $this->getTitle() . '" />';
	}
}
