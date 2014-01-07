<?php
namespace gms\acp\form;

/**
 * Shows the character edit form in ACP.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	acp.form
 * @category	Guilded 2.0
 */
class CharacterEditForm extends \gms\form\CharacterEditForm {
	/**
	 * @see	\wcf\page\AbstractPage::$menuItemName
	 */
	public $activeMenuItem = 'gms.acp.menu.link.gms.character';
	
	/**
	 * @see	\wcf\page\AbstractPage::$neededPermissions
	 */
	public $neededPermissions = array('admin.gms.character.canManage');
}
