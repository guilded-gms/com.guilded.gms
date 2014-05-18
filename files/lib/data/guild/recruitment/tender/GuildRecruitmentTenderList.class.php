<?php
namespace gms\data\guild\recruitment\tender;
use wcf\data\DatabaseObjectList;

/**
 * Represents a list of guild tenders.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons <BY-NC-SA> (http://creativecommons.org/licenses/by-nc-sa/3.0/legalcode)
 * @package	com.guilded.gms
 * @subpackage	data.guild
 * @category	Guilded 2.0
 */
class GuildRecruitmentTenderList extends DatabaseObjectList {
	/**
	 * @see	\wcf\data\DatabaseObjectList::$className
	 */
	public $className = 'gms\data\guild\recruitment\tender\GuildRecruitmentTender';

	/**
	 * Returns a list of all game classes.
	 *
	 * @return	array
	 */
	public function getClasses() {
		$classes = array();

		foreach ($this->objects as $tender) {
			$classes[$tender->getClassification()->classificationID] = $tender->getClassification();
		}

		return $classes;
	}

	/**
	 * Returns a list of all games.
	 *
	 * @return	array
	 */
	public function getGames() {
		$games = array();

		foreach ($this->objects as $tender) {
			$games[$tender->getGame()->gameID] = $tender->getGame();
		}

		return $games;
	}
}
