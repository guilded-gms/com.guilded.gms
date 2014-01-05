<?php
namespace gms\system\option;
use gms\system\game\GameHandler;
use wcf\data\option\Option;
use wcf\system\exception\UserInputException;
use wcf\system\option\SelectOptionType;
use wcf\system\WCF;

class GameSelectOptionType extends SelectOptionType {
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
			'selectOptions' => $this->getSelectOptions(),
			'value' => $value
		));
		return WCF::getTPL()->fetch('selectOptionType');
	}

	/**
	 * @see	\wcf\system\option\IOptionType::validate()
	 */
	public function validate(Option $option, $newValue) {
		if (!empty($newValue)) {
			$options = $this->getSelectOptions();
			if (!isset($options[$newValue])) {
				throw new UserInputException($option->optionName, 'validationFailed');
			}
		}
	}

	/**
	 * Get possible select-options.
	 *
	 * @return	array
	 */
	public function getSelectOptions(){
		$result = array();

		foreach (GameHandler::getGames() as $game) {
			$result[$game->gameID] = $game->getTitle();
		}
		
		return $result;
	}
}
