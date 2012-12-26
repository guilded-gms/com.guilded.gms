<?php
namespace wcf\system\menu\guild\profile\content;

interface IGuildProfileMenuContent {
	/**
	 * Returns content for this guild profile menu item.
	 * 
	 * @param	integer		$userID
	 * @return	string
	 */
	public function getContent($guildID);
}
