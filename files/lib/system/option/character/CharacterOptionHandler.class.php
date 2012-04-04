<?php
namespace wcf\system\option\character;
use wcf\data\option\category\OptionCategory;
use wcf\data\option\Option;
use wcf\data\character\option\ViewableCharacterOption;
use wcf\data\character\character;
use wcf\system\exception\CharacterInputException;
use wcf\system\option\OptionHandler;

/**
 * Handles character options.
 *
 * @author		Jeffrey Reichardt
 * @copyright	2012 guilded.eu
 * @license		CC by-nc-sa
 * @package	com.guilded.wcf.character
 * @subpackage	system.option.character
 * @category 	Community Framework
 */
class CharacterOptionHandler extends OptionHandler {
	
	/**
	 * true, if empty options should be removed
	 * @var	boolean
	 */
	public $removeEmptyOptions = false;
	
	/**
	 * current character
	 * @var	wcf\data\character\Character
	 */
	public $character = null;
	
	/**
	 * Hides empty options.
	 */
	public function hideEmptyOptions() {
		$this->removeEmptyOptions = true;
	}
	
	/**
	 * Shows empty options.
	 */
	public function showEmptyOptions() {
		$this->removeEmptyOptions = false;
	}

	/**
	 * Sets option values for a certain character.
	 * 
	 * @param	wcf\data\character\Character	$character
	 * @param	array<string>		$ignoreCategories
	 */
	public function setCharacter(Character $character, array $ignoreCategories = array()) {
		$this->optionValues = array();
		$this->character = $character;
		
		if (!$this->didInit) {
			$this->loadActiveOptions($this->categoryName, $ignoreCategories);
			
			$this->didInit = true;
		}
		
		foreach ($this->options as $option) {
			$characterOption = 'characterOption' . $option->optionID;
			$this->optionValues[$option->optionName] = $this->character->{$characterOption};
		}
	}
	
	/**
	 * @see	wcf\system\option\OptionHandler::getOption()
	 */
	public function getOption($optionName) {
		$optionData = parent::getOption($optionName);
		
		$optionData['object'] = new ViewableCharacterOption($optionData['object']);
		if ($this->character !== null) {
			$optionData['object']->setOptionValue($this->character);
		}
		
		if ($this->removeEmptyOptions && empty($optionData['object']->optionValue)) {
			return null;
		}
		
		return $optionData;
	}
	
	/**
	 * @see	wcf\system\option\OptionHandler::validateOption()
	 */
	protected function validateOption(Option $option) {
		parent::validateOption($option);
		
		if ($option->required && empty($this->optionValues[$option->optionName])) {
			throw new CharacterInputException($option->optionName);
		}
	}
	
	/**
	 * @see	wcf\system\option\OptionHandler::checkCategory()
	 */
	protected function checkCategory(OptionCategory $category) {
		if ($category->categoryName == 'hidden') {
			return false;
		}
		
		return parent::checkCategory($category);
	}
	
	/**
	 * @see	wcf\system\option\OptionHandler::checkVisibility()
	 */
	protected function checkVisibility(Option $option) {
		if ($this->character !== null) {
			$option->setCharacter($this->character);
		}
		
		if ($this->inRegistration && !$option->askDuringRegistration) {
			return false;
		}
		
		return $option->isVisible();
	}
	
	/**
	 * @see wcf\system\option\OptionHandler::save()
	 */
	public function save($categoryName = null, $optionPrefix = null) {
		$options = parent::save($categoryName, $optionPrefix);
		
		// remove options which are not asked during registration
		if ($this->inRegistration && !empty($options)) {
			foreach ($this->options as $option) {
				if (!$option->askDuringRegistration && array_key_exists($option->optionID, $options)) {
					unset($options[$option->optionID]);
				}
			}
		}
		
		return $options;
	}
}
