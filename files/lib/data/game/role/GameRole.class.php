<?php
namespace gms\data\game\role;
use gms\data\game\Game;
use gms\data\GMSDatabaseObject;
use wcf\system\WCF;

/**
 * Represents a game role.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	data.game.role
 * @category	Guilded 2.0
 */
class GameRole extends GMSDatabaseObject {
	/**
	 * @see	\wcf\data\DatabaseObject::$databaseTableName
	 */
	protected static $databaseTableName = 'game_role';
	
	/**
	 * @see	\wcf\data\DatabaseObject::$databaseTableIndexName
	 */
	protected static $databaseTableIndexName = 'roleID';

	/**
	 * game object
	 * @var	\gms\data\game\Game
	 */
	protected $game = null;

	/**
	 * Returns game of class.
	 *
	 * @return	\gms\data\game\Game
	 */
	public function getGame() {
		if ($this->game === null) {
			$this->game = new Game($this->gameID);
		}

		return $this->game;
	}

	/**
	 * Returns localized title of role.
	 *
	 * @return	string
	 */
	public function getTitle() {
		return WCF::getLanguage()->get('gms.game.' . $this->getGame()->title . '.role.' . $this->title);
	}

	/**
	 * Returns image tag with given size.
	 *
	 * @param	integer	$size
	 * @return	string
	 */
	public function getImageTag($size = 32) {
		return '<img src="' . WCF::getPath('gms') . 'icon/' . $this->getGame()->title . '/' . $this->icon . $size . '.png' . '" alt="" title="' . $this->getTitle() . '" />';
	}
}
