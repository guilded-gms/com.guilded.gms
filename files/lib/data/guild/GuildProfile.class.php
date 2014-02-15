<?php
namespace gms\data\guild;
use wcf\data\user\User;
use wcf\data\user\UserProfile;
use wcf\data\DatabaseObjectDecorator;
use wcf\system\breadcrumb\Breadcrumb;
use wcf\system\breadcrumb\IBreadcrumbProvider;
use wcf\system\request\LinkHandler;
use wcf\util\StringUtil;

/**
 * Decorates the guild object and provides functions to retrieve data for guild profiles.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	data.guild
 * @category 	Guilded 2.0
 */
class GuildProfile extends DatabaseObjectDecorator implements IBreadcrumbProvider {
	/**
	 * @see	\wcf\data\DatabaseObjectDecorator::$baseClass
	 */
	protected static $baseClass = 'gms\data\guild\Guild';

	/**
	 * cached list of guild profiles
	 * @var	array<\gms\data\guild\GuildProfile>
	 */
	protected static $guildProfiles = array();

	/**
	 * user profile object
	 * @var	\wcf\data\user\UserProfile
	 */
	protected $userProfile = null;
	
	/**
	 * Returns image tag in given size.
	 */
	public function getImageTag($size = 0) {
		return '<img src="'.StringUtil::encodeHTML($this->image).'" alt="'.($size > 0 ? ' style="max-width:'.$size.'px;max-height:'.$size.'px;"':'').' title="'.$this->getTitle().'" />';
	}

	/**
	 * Returns guild object by given guildID.
	 *
	 * @param	integer		$guildID
	 * @return	\gms\data\guild\GuildProfile|null
	 */
	public static function getGuildProfile($guildID) {
		$guilds = self::getGuildProfiles(array($guildID));

		return (isset($guilds[$guildID]) ? $guilds[$guildID] : null);
	}

	/**
	 * Returns a list of guild profiles.
	 *
	 * @param	array	$guildIDs
	 * @return	array<\gms\data\guild\GuildProfile>
	 */
	public static function getGuildProfiles(array $guildIDs) {
		$guilds = array();

		// check cache
		foreach ($guildIDs as $index => $guildID) {
			if (isset(self::$guildProfiles[$guildID])) {
				$guilds[$guildID] = self::$guildProfiles[$guildID];
				unset($guildIDs[$index]);
			}
		}

		if (!empty($guildIDs)) {
			$guildList = new GuildProfileList();
			$guildList->getConditionBuilder()->add("guild.guildID IN (?)", array($guildIDs));
			$guildList->sqlLimit = 0;
			$guildList->readObjects();

			foreach ($guildList->getObjects() as $guild) {
				self::$guildProfiles[$guild->guildID] = $guild;

				$guilds[$guild->guildID] = $guild;
			}
		}

		return $guilds;
	}
	
	/**
	 * @see	\wcf\system\breadcrumb\IBreadcrumbProvider::getBreadcrumb()
	 */
	public function getBreadcrumb() {
		return new Breadcrumb($this->name, LinkHandler::getInstance()->getLink('Guild', array(
			'object' => $this
		)));
	}

	/**
	 * Returns the user profile object.
	 *
	 * @return	\wcf\data\user\UserProfile
	 */
	public function getUserProfile() {
		if ($this->userProfile === null) {
			$this->userProfile = new UserProfile(new User($this->getDecoratedObject()->userID));
		}

		return $this->userProfile;
	}
}
