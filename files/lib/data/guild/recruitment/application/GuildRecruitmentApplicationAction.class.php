<?php
namespace gms\data\guild\recruitment\application;
use gms\data\character\CharacterAction;
use gms\data\character\CharacterEditor;
use wcf\data\AbstractDatabaseObjectAction;
use wcf\data\user\UserEditor;
use wcf\system\mail\Mail;
use wcf\system\WCF;

/**
 * Recruitment application related actions.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons <BY-NC-SA> (http://creativecommons.org/licenses/by-nc-sa/3.0/legalcode)
 * @package	com.guilded.gms
 * @subpackage	data.guild.recruitment.application
 * @category	Guilded 2.0
 */
class GuildRecruitmentApplicationAction extends AbstractDatabaseObjectAction {
	/**
	 * @see	\wcf\data\AbstractDatabaseObjectAction::$className
	 */
	public $className = 'gms\data\guild\recruitment\application\GuildRecruitmentApplicationEditor';

	/**
	 * @see	\wcf\data\AbstractDatabaseObjectAction::$permissionsCreate
	 */
	protected $permissionsCreate = array('user.gms.guild.canApply');

	/**
	 * @see	\wcf\data\AbstractDatabaseObjectAction::$permissionsDelete
	 */
	protected $permissionsDelete = array('mod.gms.guild.canManageRecruitment');

	/**
	 * @see	\wcf\data\AbstractDatabaseObjectAction::$permissionsUpdate
	 */
	protected $permissionsUpdate = array('mod.gms.guild.canManageRecruitment');

	/**
	 * Validates accept.
	 */
	public function validateAccept() {
		$this->validateUpdate();
	}

	/**
	 * Accepts guild application.
	 *
	 * @return	array
	 */
	public function accept() {
		if (empty($this->objects)) {
			$this->readObjects();
		}

		$objectIDs = array();
		foreach ($this->objects as $recruitmentEditor) {
			$recruitmentEditor->update(array(
				'isAccepted' => 1,
				'statusTime' => TIME_NOW
			));

			// assign character to guild
			$objectAction = new CharacterAction(array($recruitmentEditor->characterID), 'assignToGuild', array('data' => array(
				'guildID' => $recruitmentEditor->guildID
			)));
			$objectAction->executeAction();

			// send mail
			$messageData = array(
				'username' => $recruitmentEditor->getUser()->username,
				'guildName' => $recruitmentEditor->getGuild()->getTitle(),
				'characterName' => $recruitmentEditor->getCharacter()->getTitle()
			);
			$mail = new Mail(
				array($recruitmentEditor->getUser()->username => $recruitmentEditor->getUser(),
				WCF::getLanguage()->getDynamicVariable('gms.guild.recruitment.application.accept.mail.subject'),
				WCF::getLanguage()->getDynamicVariable('gms.guild.recruitment.application.accept.mail',
				$messageData))
			);
			$mail->send();

			// add to user group
			if ($recruitmentEditor->getGuild()->groupID) {
				$userEditor = new UserEditor($recruitmentEditor->getUser());
				$userEditor->addToGroup($recruitmentEditor->getGuild()->groupID);
			}

			// save affected objectIDs
			$objectIDs[] = $recruitmentEditor->characterID;
		}

		return array(
			'objectIDs' => $objectIDs
		);
	}

	/**
	 * Validates decline.
	 */
	public function validateDecline() {
		$this->validateUpdate();
	}

	/**
	 * Declines guild application.
	 *
	 * @return	array
	 */
	public function decline() {
		if (empty($this->objects)) {
			$this->readObjects();
		}

		$objectIDs = array();
		foreach ($this->objects as $recruitmentEditor) {
			$recruitmentEditor->update(array(
				'isDeclined' => 1,
				'statusTime' => TIME_NOW
			));

			// send activation mail
			$messageData = array(
				'username' => $recruitmentEditor->getUser()->username,
				'guildName' => $recruitmentEditor->getGuild()->getTitle(),
				'characterName' => $recruitmentEditor->getCharacter()->getTitle()
			);
			$mail = new Mail(array($recruitmentEditor->getUser()->username => $recruitmentEditor->getUser(), WCF::getLanguage()->getDynamicVariable('gms.guild.recruitment.application.decline.mail.subject'), WCF::getLanguage()->getDynamicVariable('gms.guild.recruitment.application.decline.mail', $messageData)));
			$mail->send();

			// remove character, if option is active
			if (GUILD_RECRUITMENT_DECLINE_CHARACTER) {
				CharacterEditor::deleteAll(array($recruitmentEditor->characterID));
			}

			// save affected objectIDs
			$objectIDs[] = $recruitmentEditor->characterID;
		}

		return array(
			'objectIDs' => $objectIDs
		);
	}
}
