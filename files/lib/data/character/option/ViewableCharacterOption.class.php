<?php
namespace gms\data\character\option;
use gms\data\character\Character;
use wcf\data\DatabaseObjectDecorator;
use wcf\system\exception\SystemException;
use wcf\util\ClassUtil;
use wcf\util\StringUtil;

/**
 * Decorates CharacterOption
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	data.character.option
 * @category	Guilded 2.0
 */
class ViewableCharacterOption extends DatabaseObjectDecorator {
	/**
	 * @see	\wcf\data\DatabaseObjectDecorator::$baseClass
	 */
	protected static $baseClass = 'gms\data\character\option\CharacterOption';
	
	/**
	 * list of output objects
	 * @var	array<\wcf\system\option\character\ICharacterOptionOutput>
	 */
	public static $outputObjects = array();
	
	/**
	 * character option value
	 * @var	string
	 */
	public $optionValue = '';
	
	/**
	 * character option output data
	 * @var	array
	 */
	public $outputData = array();
	
	/**
	 * Sets option values for a specific character.
	 * 
	 * @param	\gms\data\character\Character	$character
	 * @param	string							$outputType
	 */
	public function setOptionValue(Character $character, $outputType = 'normal') {
		$characterOption = 'characterOption' . $this->optionID;
		$optionValue = $character->{$characterOption};
		
		// use output class
		if ($this->outputClass) {
			$this->optionValue = $this->getOutputObject()->getOutput($character, $this->getDecoratedObject(), $optionValue);
		}
		else {
			$this->optionValue = StringUtil::encodeHTML($optionValue);
		}
	}
	
	/**
	 * Returns the output object for current character option.
	 *
	 * @throws	\wcf\system\exception\SystemException
	 * @return	\gms\system\option\character\ICharacterOptionOutput
	 */
	public function getOutputObject() {
		if (!isset(self::$outputObjects[$this->outputClass])) {
			// create instance
			if (!class_exists($this->outputClass)) {
				throw new SystemException("unable to find class '".$this->outputClass."'");
			}
			
			// validate interface
			if (!ClassUtil::isInstanceOf($this->outputClass, 'gms\system\option\character\ICharacterOptionOutput')) {
				throw new SystemException("'".$this->outputClass."' should implement \gms\system\option\character\ICharacterOptionOutput");
			}
			
			self::$outputObjects[$this->outputClass] = new $this->outputClass();
		}
		
		return self::$outputObjects[$this->outputClass];
	}
}
