<?php
namespace gms\system\option;
use gms\data\game\Game;
use gms\system\game\GameHandler;
use wcf\data\option\Option;
use wcf\system\exception\UserInputException;
use wcf\system\option\SelectOptionType;
use wcf\system\WCF;

class GameSelectOptionType extends SelectOptionType implements IGameOptionType {
	/**
	 * template name
	 * @var    string
	 */
	public $templateName = 'selectOptionType';

	/**
	 * game object
	 * @var	\gms\data\game\Game
	 */
	protected $game = null;

	/**
	 * @see	\wcf\system\option\IOptionType::getFormElement()
	 */
	public function getFormElement(Option $option, $value) {
		// get options
		$options = $this->parseEnableOptions($option);

		WCF::getTPL()->assign(array(
			'disableOptions' => $options['disableOptions'],
			'enableOptions' => $options['enableOptions'],
			'option' => $option,
			'selectOptions' => $this->parseSelectOptions(),
			'value' => $value
		));

		return WCF::getTPL()->fetch($this->templateName);
	}

	/**
	 * @see	\wcf\system\option\IOptionType::validate()
	 */
	public function validate(Option $option, $newValue) {
		if (!empty($newValue)) {
			if (!is_array($newValue)) $newValue = array($newValue);

			$options = $this->parseSelectOptions();

			foreach ($newValue as $value) {
				if (!isset($options[$value])) {
					throw new UserInputException($option->optionName, 'validationFailed');
				}
			}
		}
	}

	/**
	 * Get possible select-options.
	 *
	 * @return	array
	 */
	public function parseSelectOptions(){
		$result = array();

		foreach (GameHandler::getGames() as $game) {
			$result[$game->gameID] = $game->getTitle();
		}
		
		return $result;
	}

	/**
	 * @see \gms\system\option\IGameOptionType::setGame()
	 */
	public function setGame(Game $game) {
		$this->game = $game;
	}
}
