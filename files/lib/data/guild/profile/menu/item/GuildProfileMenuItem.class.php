<?php
namespace wcf\data\guild\profile\menu\item;
use wcf\data\DatabaseObject;
use wcf\system\exception\SystemException;
use wcf\util\ClassUtil;

/**
 * Represents an guild profile menu item.
 */
class GuildProfileMenuItem extends DatabaseObject {
	/**
	 * content manager
	 * @var	wcf\system\menu\guild\profile\content\IGuildProfileContent
	 */
	protected $contentManager = null;
	
	/**
	 * @see	wcf\data\DatabaseObject::$databaseTableName
	 */
	protected static $databaseTableName = 'guild_profile_menu_item';
	
	/**
	 * @see	wcf\data\DatabaseObject::$databaseTableIndexName
	 */
	protected static $databaseTableIndexName = 'menuItemID';
	
	/**
	 * Returns the item identifier, dots are replaced by underscores.
	 * 
	 * @return	string
	 */
	public function getIdentifier() {
		return str_replace('.', '_', $this->menuItem);
	}
	
	/**
	 * Returns the content manager for this menu item.
	 * 
	 * @return	wcf\system\menu\guild\profile\content\IGuildProfileMenuContent
	 */
	public function getContentManager() {
		if ($this->contentManager === null) {
			if (!class_exists($this->className)) {
				throw new SystemException("Unable to find class '".$this->className."'");
			}
			
			if (!ClassUtil::isInstanceOf($this->className, 'wcf\system\SingletonFactory')) {
				throw new SystemException("'".$this->className."' does not extend 'wcf\system\SingletonFactory'");
			}
			
			if (!ClassUtil::isInstanceOf($this->className, 'wcf\system\menu\guild\profile\content\IGuildProfileMenuContent')) {
				throw new SystemException("'".$this->className."' does not implement 'wcf\system\menu\guild\profile\content\IGuildProfileMenuContent'");
			}
			
			$this->contentManager = call_guild_func(array($this->className, 'getInstance'));
		}
		
		return $this->contentManager;
	}
}
