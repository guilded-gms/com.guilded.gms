<?php
namespace gms\system\option\character;
use gms\data\character\option\ViewableCharacterOption;
use gms\data\character\Character;
use gms\data\game\Game;
use gms\system\option\IGameOptionType;
use wcf\data\option\category\OptionCategory;
use wcf\data\option\Option;
use wcf\system\exception\CharacterInputException;
use wcf\system\exception\UserInputException;
use wcf\system\option\OptionHandler;

/**
 * Handles character options.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2013 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons <BY-NC-SA> (http://creativecommons.org/licenses/by-nc-sa/3.0/legalcode)
 * @package	com.guilded.gms
 * @subpackage	system.option.character
 * @category	Guilded 2.0
 */
class CharacterOptionHandler extends OptionHandler {
	/**
	 * @see	\wcf\system\option\OptionHandler::$cacheClass
	 */
	protected $cacheClass = 'gms\system\cache\builder\CharacterOptionCacheBuilder';

	/**
	 * @see	\wcf\system\option\OptionHandler::$removeEmptyOptions
	 */
	public $removeEmptyOptions = false;
	
	/**
	 * current character
	 * @var	\gms\data\character\Character
	 */
	public $character = null;

	/**
	 * filter by game
	 * @var	\gms\data\game\Game
	 */
	public $game = null;
	
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
	 * @param	\gms\data\character\Character	$character
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
	 * Sets game to OptionHandler and filters by.
	 *
	 * @param	\gms\data\game\Game	$game
	 */
	public function setGame(Game $game) {
		$this->game = $game;
	}
	
	/**
	 * @see	\wcf\system\option\OptionHandler::getOption()
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
	 * @see	\wcf\system\option\OptionHandler::validateOption()
	 */
	protected function validateOption(Option $option) {
		parent::validateOption($option);
		
		if ($option->required && empty($this->optionValues[$option->optionName])) {
			throw new UserInputException($option->optionName);
		}
	}
	
	/**
	 * @see	\wcf\system\option\OptionHandler::checkCategory()
	 */
	protected function checkCategory(OptionCategory $category) {
		if ($category->categoryName == 'hidden') {
			return false;
		}
		
		return parent::checkCategory($category);
	}
	
	/**
	 * @see	\wcf\system\option\OptionHandler::checkVisibility()
	 */
	protected function checkVisibility(Option $option) {
		if ($this->character !== null) {
			$option->setCharacter($this->character);
		}

		return $option->isVisible();
	}

	/**
	 * @see	\wcf\system\option\OptionHandler::getTypeObject()
	 */
	public function getTypeObject($type) {
		parent::getTypeObject($type);

		// set game id
		if ($this->typeObjects[$type] instanceof IGameOptionType) {
			$this->typeObjects[$type]->setGame($this->game);
		}

		return $this->typeObjects[$type];
	}
}
