<?php
namespace gms\system\option\character;
use gms\data\character\option\GuildOption;
use gms\data\character\Guild;
use wcf\system\WCF;
use wcf\util\OptionUtil;

/**
 * GuildOptionOutputSelectOptions is an implementation of IGuildOptionOutput for the output of a date input.
 *
 * @author		Jeffrey Reichardt
 * @copyright	2012 guilded.eu
 * @license		CC by-nc-sa
 * @package	com.guilded.gms
 * @subpackage	system.option.character
 * @category 	Community Framework
 */
class GuildOptionOutputSelectOptions implements IGuildOptionOutput {
	/**
	 * @see	\wcf\system\option\character\IGuildOptionOutput::getShortOutput()
	 */
	public function getShortOutput(Guild $character, GuildOption $option, $value) {
		return $this->getOutput($character, $option, $value);
	}
	
	/**
	 * @see	\wcf\system\option\character\IGuildOptionOutput::getMediumOutput()
	 */
	public function getMediumOutput(Guild $character, GuildOption $option, $value) {
		return $this->getOutput($character, $option, $value);
	}

	/**
	 * @see	\wcf\system\option\character\IGuildOptionOutput::getOutput()
	 */
	public function getOutput(Guild $character, GuildOption $option, $value) {
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
	 * @param	GuildOption	$option
	 * @param	$value
	 * @return	array|null
	 */
	protected static function getResult(GuildOption $option, $value) {
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
		else {
			if (!empty($value) && isset($options[$value])) return $options[$value];
			return null;
		}
	}
}
