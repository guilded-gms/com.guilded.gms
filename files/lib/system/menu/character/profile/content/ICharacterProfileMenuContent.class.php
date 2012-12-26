<?php
namespace wcf\system\menu\character\profile\content;

interface ICharacterProfileMenuContent {
	/**
	 * Returns content for this character profile menu item.
	 * 
	 * @param	integer		$userID
	 * @return	string
	 */
	public function getContent($characterID);
}
