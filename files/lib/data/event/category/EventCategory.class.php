<?php
namespace gms\data\event\category;
use wcf\data\category\AbstractDecoratedCategory;
use wcf\system\category\CategoryHandler;
use wcf\system\category\CategoryPermissionHandler;

class EventCategory extends AbstractDecoratedCategory {
	/**
	 * category type name
	 * @var	string
	 */
	const OBJECT_TYPE_NAME = 'com.guilded.gms.event.category';

	/**
	 * acl permissions for the active user of this category
	 * @var	array<boolean>
	 */
	protected $permissions = null;
	
	/**
	 * Returns true if the category is accessible for the active user.
	 * 
	 * @return	boolean
	 */
	public function isAccessible() {
		if ($this->getObjectType()->objectType != self::OBJECT_TYPE_NAME) return false;
		
		// check permissions
		return $this->getPermission('canViewCategory');
	}
	
	/**
	 * @see	\wcf\data\IPermissionObject::getPermission()
	 */
	public function getPermission($permission) {
		if ($this->permissions === null) {
			$this->permissions = CategoryPermissionHandler::getInstance()->getPermissions($this->getDecoratedObject());
		}
		
		if (isset($this->permissions[$permission])) {
			return $this->permissions[$permission];
		}
		
		return true;
	}
	
	/**
	 * Returns a list with ids of accessible categories.
	 * 
	 * @param	array	$permissions
	 * @return	array<integer>
	 */
	public static function getAccessibleCategoryIDs(array $permissions = array('canViewCategory')) {
		$categoryIDs = array();

		foreach (CategoryHandler::getInstance()->getCategories(self::OBJECT_TYPE_NAME) as $category) {
			$result = true;
			$category = new EventCategory($category);

			// check given permissions
			foreach ($permissions as $permission) {
				$result = ($result && $category->getPermission($permission));
			}
			
			if ($result) {
				$categoryIDs[] = $category->categoryID;
			}
		}
		
		return $categoryIDs;
	}
}
