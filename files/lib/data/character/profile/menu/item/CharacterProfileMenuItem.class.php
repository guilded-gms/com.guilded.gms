<?php
namespace gms\data\character\profile\menu\item;
use wcf\data\user\profile\menu\item\UserProfileMenuItem;
use wcf\system\exception\SystemException;
use wcf\util\ClassUtil;

/**
 * Represents an character profile menu item.
 */
class CharacterProfileMenuItem extends UserProfileMenuItem {
	/**
	 * @see	\wcf\data\DatabaseObject::$databaseTableName
	 */
	protected static $databaseTableName = 'character_profile_menu_item';

	/**
	 * @see	\wcf\data\IStorableObject::getDatabaseTableName()
	 */
	public static function getDatabaseTableName() {
		return 'gms'.WCF_N.'_'.static::$databaseTableName;
	}

	/**
	 * Returns the content manager for this menu item.
	 *
	 * @return	\wcf\system\menu\character\profile\content\ICharacterProfileMenuContent
	 */
	public function getContentManager() {
		if ($this->contentManager === null) {
			if (!class_exists($this->className)) {
				throw new SystemException("Unable to find class '".$this->className."'");
			}

			if (!ClassUtil::isInstanceOf($this->className, 'wcf\system\SingletonFactory')) {
				throw new SystemException("'".$this->className."' does not extend 'wcf\system\SingletonFactory'");
			}

			if (!ClassUtil::isInstanceOf($this->className, 'gms\system\menu\character\profile\content\ICharacterProfileMenuContent')) {
				throw new SystemException("'".$this->className."' does not implement 'gms\system\menu\character\profile\content\ICharacterProfileMenuContent'");
			}

			$this->contentManager = call_user_func(array($this->className, 'getInstance'));
		}

		return $this->contentManager;
	}
}
