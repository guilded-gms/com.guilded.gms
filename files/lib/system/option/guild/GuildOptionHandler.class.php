<?php
namespace gms\system\option\guild;
use gms\data\game\Game;
use gms\data\guild\guild;
use gms\data\guild\option\ViewableGuildOption;
use gms\system\option\IGameOptionType;
use wcf\data\option\category\OptionCategory;
use wcf\data\option\Option;
use wcf\system\exception\UserInputException;
use wcf\system\option\OptionHandler;

/**
 * Handles guild options.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons <BY-NC-SA> (http://creativecommons.org/licenses/by-nc-sa/3.0/legalcode)
 * @package	com.guilded.wcf.guild
 * @subpackage	system.option.guild
 * @category	Guilded 2.0
 */
class GuildOptionHandler extends OptionHandler {
	/**
	 * @see	\wcf\system\option\OptionHandler::$cacheClass
	 */
	protected $cacheClass = 'gms\system\cache\builder\GuildOptionCacheBuilder';

	/**
	 * true, if empty options should be removed
	 * @var	boolean
	 */
	public $removeEmptyOptions = false;
	
	/**
	 * current guild
	 * @var	\gms\data\guild\Guild
	 */
	public $guild = null;

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
	 * Sets option values for a certain guild.
	 * 
	 * @param	\gms\data\guild\Guild	$guild
	 * @param	array<string>		$ignoreCategories
	 */
	public function setGuild(Guild $guild, array $ignoreCategories = array()) {
		$this->optionValues = array();
		$this->guild = $guild;
		$this->setGame($guild->getGame());
		
		if (!$this->didInit) {
			$this->loadActiveOptions($this->categoryName, $ignoreCategories);
			
			$this->didInit = true;
		}
		
		foreach ($this->options as $option) {
			$guildOption = 'guildOption' . $option->optionID;
			$this->optionValues[$option->optionName] = $this->guild->{$guildOption};
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
		
		$optionData['object'] = new ViewableGuildOption($optionData['object']);
		if ($this->guild !== null) {
			$optionData['object']->setOptionValue($this->guild);
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
		if ($this->guild !== null) {
			$option->setGuild($this->guild);
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
