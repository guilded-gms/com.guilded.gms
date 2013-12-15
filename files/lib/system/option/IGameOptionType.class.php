<?php
namespace gms\system\option;
use gms\data\game\Game;

/**
 * Every OptionType for specific game values should implement this interface.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2013 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	system.option
 * @category	Guilded 2.0
 */
interface IGameOptionType {
	/**
	 * Sets game object of OptionType.
	 *
	 * @param \gms\data\game\Game $game
	 */
	public function setGame(Game $game);
}