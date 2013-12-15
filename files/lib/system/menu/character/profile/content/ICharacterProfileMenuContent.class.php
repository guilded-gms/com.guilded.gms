<?php
namespace gms\system\menu\character\profile\content;
use gms\data\character\Character;

interface ICharacterProfileMenuContent {
	/**
	 * Returns the number of items for menu item of the given character.
	 *
	 * @param	\gms\data\character\Character	$character
	 * @return	integer
	 */
	public function getNumberOfItems(Character $character);

	/**
	 * Returns true if this menu item of the given character is accessible by current user.
	 *
	 * @param	\gms\data\character\Character	$character
	 * @return	boolean
	 */
	public function isAccessible(Character $character);

	/**
	 * Returns content for this character profile menu item.
	 * 
	 * @param	\gms\data\character\Character	$character
	 * @return	string
	 */
	public function getContent(Character $character);
}
