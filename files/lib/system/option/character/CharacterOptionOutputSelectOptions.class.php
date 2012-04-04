<?php
namespace wcf\system\option\character;
use wcf\data\character\option\CharacterOption;
use wcf\data\character\Character;
use wcf\system\WCF;
use wcf\util\OptionUtil;
use wcf\util\StringUtil;

/**
 * CharacterOptionOutputSelectOptions is an implementation of ICharacterOptionOutput for the output of a date input.
 *
 * @author		Jeffrey Reichardt
 * @copyright	2012 guilded.eu
 * @license		CC by-nc-sa
 * @package	com.guilded.wcf.character
 * @subpackage	system.option.character
 * @category 	Community Framework
 */
class CharacterOptionOutputSelectOptions implements ICharacterOptionOutput {
	/**
	 * @see wcf\system\option\character\ICharacterOptionOutput::getShortOutput()
	 */
	public function getShortOutput(Character $character, CharacterOption $option, $value) {
		return $this->getOutput($character, $option, $value);
	}
	
	/**
	 * @see wcf\system\option\character\ICharacterOptionOutput::getMediumOutput()
	 */
	public function getMediumOutput(Character $character, CharacterOption $option, $value) {
		return $this->getOutput($character, $option, $value);
	}

	/**
	 * @see wcf\system\option\character\ICharacterOptionOutput::getOutput()
	 */
	public function getOutput(Character $character, CharacterOption $option, $value) {
		$result = self::getResult($option, $value);
		if ($result === null) {
			return '';
		}
		else if (is_array($result)) {
			$output = '';
			foreach ($result as $resultValue) {
				if (!empty($output)) $output .= "<br />\n";
				$output .= WCF::getLanguage()->get($resultValue);
			}
			
			return $output;
		}
		else {
			return WCF::getLanguage()->get($result);
		}
	}

	/**
	 * Returns values of given option.
	 *
	 * @return array | null
	 */	
	protected static function getResult(CharacterOption $option, $value) {
		$options = OptionUtil::parseSelectOptions($option->selectOptions);
		
		// multiselect
		if (StringUtil::indexOf($value, "\n") !== false) {
			$values = explode("\n", $value);
			$result = array();
			foreach ($values as $value) {
				if (isset($options[$value])) {
					$result[] = $options[$value];
				}
			}
			
			return $result;
		}
		else {
			if (!empty($value) && isset($options[$value])) return $options[$value];
			return null;
		}
	}
}
?>
