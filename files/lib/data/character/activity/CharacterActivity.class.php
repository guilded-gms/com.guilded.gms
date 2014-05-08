<?php
namespace gms\data\character\activity;
use gms\data\character\Character;
use gms\data\GMSDatabaseObject;
use wcf\system\WCF;

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
