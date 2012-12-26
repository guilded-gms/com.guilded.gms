<?php
namespace wcf\acp\form;
use wcf\system\language\LanguageFactory;

/**
 * This class provides default implementations for a list of dynamic character options.
 */
abstract class CharacterOptionListForm extends AbstractOptionListForm {
	/**
	 * @see	wcf\acp\form\AbstractOptionListForm::$cacheName
	 */
	public $cacheName = 'characterOption';
	
	/**
	 * @see	wcf\acp\form\AbstractOptionListForm::$supportI18n
	 */
	public $supportI18n = false;
	
	/**
	 * @see	wcf\acp\form\AbstractOptionListForm::$optionHandlerClassName
	 */
	public $optionHandlerClassName = 'wcf\system\option\character\CharacterOptionHandler';
	
	/**
	 * Returns the default form language id.
	 * 
	 * @return	integer	$languageID
	 */
	protected function getDefaultFormLanguageID() {
		return LanguageFactory::getInstance()->getDefaultLanguageID();
	}
}
