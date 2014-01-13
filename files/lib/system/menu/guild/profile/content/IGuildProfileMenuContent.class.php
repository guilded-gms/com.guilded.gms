<?php
namespace gms\system\menu\guild\profile\content;
use gms\data\guild\Guild;

interface IGuildProfileMenuContent {
	/**
	 * Returns the number of items for menu item of the given guild.
	 *
	 * @param	\gms\data\guild\Guild	$guild
	 * @return	integer
	 */
	public function getNumberOfItems(Guild $guild);

	/**
	 * Returns true if this menu item of the given guild is accessible by current user.
	 *
	 * @param	\gms\data\guild\Guild	$guild
	 * @return	boolean
	 */
	public function isAccessible(Guild $guild);

	/**
	 * Returns content for this guild profile menu item.
	 *
	 * @param	\gms\data\guild\Guild	$guild
	 * @return	string
	 */
	public function getContent(Guild $guild);
}
