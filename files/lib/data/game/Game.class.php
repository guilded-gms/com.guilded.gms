<?php
namespace gms\data\game;
use gms\data\game\classification\GameClassificationList;
use gms\data\game\faction\GameFactionList;
use gms\data\game\instance\GameInstanceList;
use gms\data\game\item\GameItemList;
use gms\data\game\race\GameRaceList;
use gms\data\game\role\GameRoleList;
use gms\data\GMSDatabaseObject;
use gms\system\game\provider\GameProviderHandler;
use gms\system\GMSCore;
use wcf\system\request\IRouteController;
use wcf\system\WCF;

/**
 * Represents a game.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
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

	/**
	 * list of game factions
	 * @var	\gms\data\game\faction\GameFactionList
	 */
	protected $factionList = null;

	/**
	 * list of game races
	 * @var	\gms\data\game\race\GameRaceList
	 */
	protected $raceList = null;

	/**
	 * list of game classes
	 * @var	\gms\data\game\classification\GameClassificationList
	 */
	protected $classList = null;

	/**
	 * list of game roles
	 * @var	\gms\data\game\role\GameRoleList
	 */
	protected $roleList = null;

	/**
	 * list of game classes
	 * @var	\gms\data\game\instance\GameInstanceList
	 */
	protected $instanceList = null;

	/**
	 * list of game items
	 * @var	\gms\data\game\item\GameItemList
	 */
	protected $itemList = null;

	/**
	 * Returns game by given abbreviation.
	 *
	 * @param	string	$abbreviation
	 * @return	\gms\data\game\Game|null
	 */
	public static function getGameByAbbreviation($abbreviation) {
		$sql = "SELECT game.*
				FROM	".static::getDatabaseTableName()." game
				WHERE	(game.title = ?)";
		$statement = WCF::getDB()->prepareStatement($sql);
		$statement->execute(array($abbreviation));
		$row = $statement->fetchArray();

		if (!$row) {
			return null;
		}

		return new Game(null, $row);
	}

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
	 * @return	\gms\system\game\provider\GameProvider
	 */
	public function getProvider() {
		return GameProviderHandler::getInstance()->getObjectType('com.guilded.gms.provider.' . mb_strtolower($this->title));
	}

	/**
	 * Returns full path to icon.
	 *
	 * @param	integer	$size
	 * @return	string
	 */
	public function getIcon($size = 32) {
		$filePath = 'icon/' . $this->title . '/' . $this->icon . $size . '.png';
		if (!file_exists(GMS_DIR . $filePath)) {
			return '';
		}

		return WCF::getPath('gms') . $filePath;
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
	 * @return	\gms\data\game\classification\GameClassificationList
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
		$iconPath = $this->getIcon(32);
		if (!empty($iconPath)) {
			return '<img src="' . $iconPath . '" style="width: '.$size.'px; height: '.$size.'px" alt="' . $this->getTitle() . '" />';
		}

		return '';
	}
}
