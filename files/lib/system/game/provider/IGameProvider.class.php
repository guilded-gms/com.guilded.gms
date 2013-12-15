<?php
namespace gms\system\game\provider;
use gms\data\game\Game;

/**
 * Every provider must implement this interface.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2013 DevLabor UG (haftungsbeschr�nkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	system.game.provider
 * @category	Guilded 2.0
*/
interface IGameProvider {
	/**
	 * Returns server data with given parameters from an external resource.
	 *
	 * @return	array
	 */
	public function getServer($name);
	
	/**
	 * Returns character object with given parameters from an external resource.
	 *
	 * @return	array
	 */
	public function getCharacter($server, $name);
	
	/**
	 * Returns guild data with given parameters from an external resource.
	 *
	 * @return	array
	 */	
	public function getGuild($server, $name);
	
	/**
	 * Returns item data with given parameters from an external resource.
	 *
	 * @return	array
	 */	
	public function getItem($itemID);
}
