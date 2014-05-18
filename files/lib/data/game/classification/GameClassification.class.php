<?php
namespace gms\data\game\classification;
use gms\data\game\Game;
use gms\data\GMSDatabaseObject;
use wcf\system\WCF;

/**
 * Represents a game class.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	data.game.class
 * @category	Guilded 2.0
 */
class GameClassification extends GMSDatabaseObject {
	/**
	 * @see	\wcf\data\DatabaseObject::$databaseTableName
	 */
	protected static $databaseTableName = 'game_classification';
	
	/**
	 * @see	\wcf\data\DatabaseObject::$databaseTableIndexName
	 */
	protected static $databaseTableIndexName = 'classificationID';

	/**
	 * game object
	 * @var	\gms\data\game\Game
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

	/**
	 * Returns image tag with given size. Possible sizes are 16, 32 and 48.
	 *
	 * @param	integer	$size
	 * @return	string
	 */
	public function getImageTag($size = 32) {
		return '<img src="' . WCF::getPath('gms') . 'icon/' . $this->getGame()->title . '/' . $this->icon . $size . '.png' . '" alt="" title="' . $this->getTitle() . '" />';
	}
}
