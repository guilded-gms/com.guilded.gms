<?php
namespace wcf\data\guild\profile\menu\item;
use wcf\data\DatabaseObjectEditor;
use wcf\data\IEditableCachedObject;
use wcf\system\cache\CacheHandler;
use wcf\system\WCF;

/**
 * Provides functions to edit guild profile menu items.
 */
class GuildProfileMenuItemEditor extends DatabaseObjectEditor implements IEditableCachedObject {
	/**
	 * @see	wcf\data\DatabaseObjectDecorator::$baseClass
	 */
	protected static $baseClass = 'wcf\data\guild\profile\menu\item\GuildProfileMenuItem';
	
	/**
	 * @see	wcf\data\IEditableObject::create()
	 */
	public static function create(array $parameters = array()) {
		// calculate show order
		$parameters['showOrder'] = self::getShowOrder($parameters['showOrder']);
		
		return parent::create($parameters);
	}
	
	/**
	 * @see	wcf\data\IEditableObject::update()
	 * 
	 * @todo Handle language id and update related language item
	 */
	public function update(array $parameters = array()) {
		if (isset($parameters['showOrder'])) {
			$this->updateShowOrder($parameters['showOrder']);
		}
		
		parent::update($parameters);
	}
	
	/**
	 * @see	wcf\data\IEditableObject::delete()
	 */
	public function delete() {
		// update show order
		$sql = "UPDATE	wcf".WCF_N."_guild_profile_menu_item
			SET	showOrder = showOrder - 1
			WHERE	showOrder >= ?";
		$statement = WCF::getDB()->prepareStatement($sql);
		$statement->execute(array($this->showOrder));
		
		parent::delete();
	}
	
	/**
	 * Updates show order for current menu item.
	 * 
	 * @param	integer		$showOrder
	 */
	protected function updateShowOrder($showOrder) {
		if ($this->showOrder != $showOrder) {
			if ($showOrder < $this->showOrder) {
				$sql = "UPDATE	wcf".WCF_N."_guild_profile_menu_item
					SET	showOrder = showOrder + 1
					WHERE	showOrder >= ?
						AND showOrder < ?";
				$statement = WCF::getDB()->prepareStatement($sql);
				$statement->execute(array(
					$showOrder,
					$this->showOrder
				));
			}
			else if ($showOrder > $this->showOrder) {
				$sql = "UPDATE	wcf".WCF_N."_guild_profile_menu_item
					SET	showOrder = showOrder - 1
					WHERE	showOrder <= ?
						AND showOrder > ?";
				$statement = WCF::getDB()->prepareStatement($sql);
				$statement->execute(array(
					$showOrder,
					$this->showOrder
				));
			}
		}
	}
	
	/**
	 * Returns show order for a new menu item.
	 * 
	 * @param	integer		$showOrder
	 * @return	integer
	 */
	protected static function getShowOrder($showOrder = 0) {
		if ($showOrder == 0) {
			// get next number in row
			$sql = "SELECT	MAX(showOrder) AS showOrder
				FROM	wcf".WCF_N."_guild_profile_menu_item";
			$statement = WCF::getDB()->prepareStatement($sql);
			$statement->execute();
			$row = $statement->fetchArray();
			if (!empty($row)) $showOrder = intval($row['showOrder']) + 1;
			else $showOrder = 1;
		}
		else {
			$sql = "UPDATE	wcf".WCF_N."_guild_profile_menu_item
				SET	showOrder = showOrder + 1
				WHERE	showOrder >= ?";
			$statement = WCF::getDB()->prepareStatement($sql);
			$statement->execute(array($showOrder));
		}
		
		return $showOrder;
	}
	
	/**
	 * @see	wcf\data\IEditableCachedObject::resetCache()
	 */
	public static function resetCache() {
		CacheHandler::getInstance()->clear(WCF_DIR.'cache', 'cache.guildProfileMenu.php');
	}
}
