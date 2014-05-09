<?php
namespace gms\data\character\activity;
use gms\data\character\Character;
use gms\data\GMSDatabaseObject;
use wcf\system\WCF;

/**
 * Represents a character activity.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	data.character.activity
 * @category	Guilded 2.0
 */
class CharacterActivity extends GMSDatabaseObject {
	/**
	 * @see	\wcf\data\DatabaseObject::$databaseTableName
	 */
	protected static $databaseTableName = 'character_activity';
	
	/**
	 * @see	\wcf\data\DatabaseObject::$databaseTableIndexName
	 */
	protected static $databaseTableIndexName = 'activityID';

	/**
	 * character object
	 * @var    \gms\data\character\Character
	 */
	protected $character = null;

	/**
	 * Returns character object.
	 *
	 * @return    \gms\data\character\Character
	 */
	public function getCharacter() {
		if ($this->character === null) {
			$this->character = new Character($this->objectID);
		}

		return $this->character;
	}

	/**
	 * Returns message title.
	 *
	 * @return    string
	 */
	public function getTitle() {
		return WCF::getLanguage()->getDynamicVariable('gms.character.activity.' . $this->languageItemName, array_merge(
			array(
				'character' => $this->getCharacter()),
				unserialize($this->additionalData)
			)
		);
	}
}
