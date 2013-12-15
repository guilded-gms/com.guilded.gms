<?php
namespace gms\data\guild\option;
use gms\data\guild\Guild;
use wcf\data\DatabaseObjectDecorator;
use wcf\system\exception\SystemException;
use wcf\system\option\guild\IGuildOptionOutputContactInformation;
use wcf\util\ClassUtil;
use wcf\util\StringUtil;

/**
 * Decorates GuildOption
 *
 * @author 		Jeffrey Reichardt
 * @copyright	2012 Guilded.eu
 * @license		CC by-nc-sa
 * @package	com.guilded.wcf.guild
 * @subpackage	data.guild.option
 * @category 	Community Framework
 */
class ViewableGuildOption extends GMSDatabaseObjectDecorator {
	/**
	 * @see	\wcf\data\DatabaseObjectDecorator::$baseClass
	 */
	protected static $baseClass = 'gms\data\guild\option\GuildOption';
	
	/**
	 * list of output objects
	 * @var	array<\wcf\system\option\guild\IGuildOptionOutput>
	 */
	public static $outputObjects = array();
	
	/**
	 * guild option value
	 * @var	string
	 */
	public $optionValue = '';
	
	/**
	 * guild option output data
	 * @var	array
	 */
	public $outputData = array();
	
	/**
	 * Sets option values for a specific guild.
	 * 
	 * @param	\gms\data\guild\Guild	$guild
	 * @param	string			$outputType
	 */
	public function setOptionValue(Guild $guild, $outputType = 'normal') {
		$guildOption = 'guildOption' . $this->optionID;
		$optionValue = $guild->{$guildOption};
		
		// use output class
		if ($this->outputClass) {
			$outputObj = $this->getOutputObject();
			
			if ($outputObj instanceof IGuildOptionOutputContactInformation) {
				$this->outputData = $outputObj->getOutputData($guild, $this->getDecoratedObject(), $optionValue);
			}
			
			if ($outputType == 'normal') $this->optionValue = $outputObj->getOutput($guild, $this->getDecoratedObject(), $optionValue);
			else if ($outputType == 'short') $this->optionValue = $outputObj->getShortOutput($guild, $this->getDecoratedObject(), $optionValue);
			else $outputType = $outputObj->getMediumOutput($guild, $this->getDecoratedObject(), $optionValue);
		}
		else {
			$this->optionValue = StringUtil::encodeHTML($optionValue);
		}
	}
	
	/**
	 * Returns the output object for current guild option.
	 * 
	 * @return	\wcf\system\option\guild\IGuildOptionOutput
	 */
	public function getOutputObject() {
		if (!isset(self::$outputObjects[$this->outputClass])) {
			// create instance
			if (!class_exists($this->outputClass)) {
				throw new SystemException("unable to find class '".$this->outputClass."'");
			}
			
			// validate interface
			if (!ClassUtil::isInstanceOf($this->outputClass, 'wcf\system\option\guild\IGuildOptionOutput')) {
				throw new SystemException("'".$this->outputClass."' should implement wcf\system\option\guild\IGuildOptionOutput");
			}
			
			self::$outputObjects[$this->outputClass] = new $this->outputClass();
		}
		
		return self::$outputObjects[$this->outputClass];
	}
}
