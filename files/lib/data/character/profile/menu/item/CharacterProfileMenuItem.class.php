<?php
namespace wcf\data\character\profile\menu\item;
use wcf\data\DatabaseObject;
use wcf\system\exception\SystemException;
use wcf\util\ClassUtil;

/**
 * Represents an character profile menu item.
 */
class CharacterProfileMenuItem extends DatabaseObject {
	/**
	 * content manager
	 * @var	wcf\system\menu\character\profile\content\ICharacterProfileContent
	 */
	protected $contentManager = null;
	
	/**
	 * @see	wcf\data\DatabaseObject::$databaseTableName
	 */
	protected static $databaseTableName = 'character_profile_menu_item';
	
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
	 * @return	wcf\system\menu\character\profile\content\ICharacterProfileMenuContent
	 */
	public function getContentManager() {
		if ($this->contentManager === null) {
			if (!class_exists($this->className)) {
				throw new SystemException("Unable to find class '".$this->className."'");
			}
			
			if (!ClassUtil::isInstanceOf($this->className, 'wcf\system\SingletonFactory')) {
				throw new SystemException("'".$this->className."' does not extend 'wcf\system\SingletonFactory'");
			}
			
			if (!ClassUtil::isInstanceOf($this->className, 'wcf\system\menu\character\profile\content\ICharacterProfileMenuContent')) {
				throw new SystemException("'".$this->className."' does not implement 'wcf\system\menu\character\profile\content\ICharacterProfileMenuContent'");
			}
			
			$this->contentManager = call_character_func(array($this->className, 'getInstance'));
		}
		
		return $this->contentManager;
	}
}
