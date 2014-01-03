<?php
namespace gms\acp\form;
use wcf\acp\form\AbstractOptionListForm;
use wcf\system\language\LanguageFactory;

/**
 * This class provides default implementations for a list of dynamic guild options.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	acp.form
 * @category	Guilded 2.0
 */
abstract class GuildOptionListForm extends AbstractOptionListForm {
	/**
	 * @see	\wcf\acp\form\AbstractOptionListForm::$cacheName
	 */
	public $cacheName = 'guildOption';
	
	/**
	 * @see	\wcf\acp\form\AbstractOptionListForm::$supportI18n
	 */
	public $supportI18n = false;
	
	/**
	 * @see	\wcf\acp\form\AbstractOptionListForm::$optionHandlerClassName
	 */
	public $optionHandlerClassName = 'gms\system\option\guild\GuildOptionHandler';
	
	/**
	 * Returns the default form language id.
	 * 
	 * @return	integer	$languageID
	 */
	protected function getDefaultFormLanguageID() {
		return LanguageFactory::getInstance()->getDefaultLanguageID();
	}
}
