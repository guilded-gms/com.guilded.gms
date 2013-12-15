<?php
namespace gms\data\game\classification;
use gms\data\game\Game;
use wcf\data\DatabaseObject;

/**
 * Represents a game class.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2013 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	data.game.class
 * @category	Guilded 2.0
 */
class GameClassification extends DatabaseObject {
	/**
	 * @see	\wcf\data\DatabaseObject::$databaseTableName
	 */
	protected static $databaseTableName = 'game_class';
	
	/**
	 * @see	\wcf\data\DatabaseObject::$databaseTableIndexName
	 */
	protected static $databaseTableIndexName = 'classID';

	/**
	 * game object
	 * @var    \gms\data\game\Game
	 */
	protected $game = null;

	/**
	 * Returns game of class.
	 *
	 * @return null|Game
	 */
	public function getGame() {
		if ($this->game === null) {
			$this->game = new Game($this->gameID);
		}

		return $this->game;
	}

	/**
	 * Returns localized title of class.
	 *
	 * @return	string
	 */
	public function getTitle() {
		return WCF::getLanguage()->get('gms.game.' . $this->getGame()->title . '.class.' . $this->title);
	}
}
