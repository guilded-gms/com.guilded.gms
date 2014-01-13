<?php
namespace gms\system\game\provider;

/**
 * Every provider must implement this interface.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	system.game.provider
 * @category	Guilded 2.0
*/
interface IGameProvider {
	/**
	 * Returns server data with given parameters from an external resource.
	 *
	 * @param	string	$name
	 * @return	array
	 */
	public function getServer($name);
	
	/**
	 * Returns character object with given parameters from an external resource.
	 *
	 * @param	string	$server
	 * @param	string	$name
	 * @return	array
	 */
	public function getCharacter($server, $name);
	
	/**
	 * Returns guild data with given parameters from an external resource.
	 *
	 * @param	string	$server
	 * @param	string	$name
	 * @return	array
	 */	
	public function getGuild($server, $name);
	
	/**
	 * Returns item data with given parameters from an external resource.
	 *
	 * @param	string	$itemID
	 * @return	array
	 */	
	public function getItem($itemID);
}
