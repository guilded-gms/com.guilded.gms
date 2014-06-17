<?php
namespace gms\system\option\character;
use gms\data\character\Character;
use gms\data\character\option\CharacterOption;
use wcf\system\WCF;
use wcf\util\OptionUtil;

/**
 * CharacterOptionOutputSelectOptions is an implementation of ICharacterOptionOutput for the output of a date input.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons <BY-NC-SA> (http://creativecommons.org/licenses/by-nc-sa/3.0/legalcode)
 * @package	com.guilded.gms
 * @subpackage	system.option.character
 * @category	Guilded 2.0
 */
class SelectOptionsCharacterOptionOutput implements ICharacterOptionOutput {
	/**
	 * @see	\wcf\system\option\character\ICharacterOptionOutput::getOutput()
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
	 * @param	CharacterOption	$option
	 * @param	mixed	$value
	 * @return	array|null
	 */
	protected static function getResult(CharacterOption $option, $value) {
		$options = OptionUtil::parseSelectOptions($option->selectOptions);
		
		// multiselect
		if (mb_strpos($value, "\n") !== false) {
			$values = explode("\n", $value);
			$result = array();
			foreach ($values as $value) {
				if (isset($options[$value])) {
					$result[] = $options[$value];
				}
			}
			
			return $result;
		}

		if (!empty($value) && isset($options[$value])) {
			return $options[$value];
		}

		return null;
	}
}
