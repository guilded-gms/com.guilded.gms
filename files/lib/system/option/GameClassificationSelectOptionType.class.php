<?php
namespace gms\system\option;
use gms\data\game\classification\GameClassificationList;
use gms\data\game\Game;
use wcf\data\option\Option;
use wcf\system\option\SelectOptionType;
use wcf\system\WCF;
use wcf\util\OptionUtil;

/**
 * Select Option for game-classes.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	system.option
 * @category	Guilded 2.0
 */
class GameClassificationSelectOptionType extends GameSelectOptionType {
	/**
	 * @see	\wcf\system\option\IOptionType::getFormElement()
	 */
	public function getFormElement(Option $option, $value) {
		if ($this->game->maxClasses > 1) {
			$this->templateName = 'multiSelectOptionType';

			if (!is_array($value)) {
				$value = explode(',', $value);
			}
		}

		return parent::getFormElement($option, $value);
	}

	/**
	 * @see	\wcf\system\option\IOptionType::validate()
	 */
	public function validate(Option $option, $newValue) {
		if (!is_array($newValue)) $newValue = array();
		$options = $option->parseSelectOptions();

		foreach ($newValue as $value) {
			if (!isset($options[$value])) {
				throw new UserInputException($option->optionName, 'validationFailed');
			}
		}

		if (count($newValue) > $this->game->maxClasses) {
			throw new UserInputException($option->optionName, 'tooMuch');
		}
	}

	/**
	 * @see	\gms\system\option\GameSelectOptionType::parseSelectOptions()
	 */
	public function parseSelectOptions(){
		$result = array();

		$classList = new GameClassificationList();
		$classList->getConditionBuilder()->add('gameID = ?', array($this->game->gameID));
		$classList->readObjects();

		foreach ($classList->getObjects() as $class) {
			$result[$class->classificationID] = $class->getTitle();
		}
		
		return $result;
	}
}
