<?php
namespace gms\data\guild\profile\menu\item;
use gms\data\GMSDatabaseObject;
use wcf\system\exception\SystemException;
use wcf\util\ClassUtil;

/**
 * Represents an guild profile menu item.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons <BY-NC-SA> (http://creativecommons.org/licenses/by-nc-sa/3.0/legalcode)
 * @package	com.guilded.gms
 * @subpackage	data.guild.profile.menu.item
 * @category	Guilded 2.0
 */
class GuildProfileMenuItem extends GMSDatabaseObject {
	/**
	 * @see	\wcf\data\DatabaseObject::$databaseTableName
	 */
	protected static $databaseTableName = 'guild_profile_menu_item';

	/**
	 * @see	\wcf\data\DatabaseObject::$databaseTableIndexName
	 */
	protected static $databaseTableIndexName = 'menuItemID';

	/**
	 * content manager
	 * @var	\gms\system\menu\guild\profile\content\IGuildProfileMenuContent
	 */
	protected $contentManager = null;

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
	 * @return	\gms\system\menu\guild\profile\content\IGuildProfileMenuContent
	 */
	public function getContentManager() {
		if ($this->contentManager === null) {
			if (!class_exists($this->className)) {
				throw new SystemException("Unable to find class '".$this->className."'");
			}

			if (!ClassUtil::isInstanceOf($this->className, 'wcf\system\SingletonFactory')) {
				throw new SystemException("'".$this->className."' does not extend 'wcf\system\SingletonFactory'");
			}

			if (!ClassUtil::isInstanceOf($this->className, 'gms\system\menu\guild\profile\content\IGuildProfileMenuContent')) {
				throw new SystemException("'".$this->className."' does not implement 'gms\system\menu\guild\profile\content\IGuildProfileMenuContent'");
			}

			$this->contentManager = call_user_func(array($this->className, 'getInstance'));
		}

		return $this->contentManager;
	}
}
