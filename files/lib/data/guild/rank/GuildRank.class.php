<?php
namespace gms\data\guild\rank;
use gms\data\GMSDatabaseObject;
use gms\data\guild\Guild;

/**
 * Represents a rank in guild.
 * 
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons <BY-NC-SA> (http://creativecommons.org/licenses/by-nc-sa/3.0/legalcode)
 * @package	com.guilded.gms
 * @subpackage	data.guild.rank
 * @category	Guilded 2.0
 */
class GuildRank extends GMSDatabaseObject {
	/**
	 * @see	\wcf\data\DatabaseObject::$databaseTableName
	 */
	protected static $databaseTableName = 'guild_rank';
	
	/**
	 * @see	\wcf\data\DatabaseObject::$databaseTableIndexName
	 */
	protected static $databaseTableIndexName = 'rankID';

	/**
	 * guild object
	 * @var	\gms\data\guild\Guild
	 */
	protected $guild = null;

	/**
	 * Returns guild object.
	 *
	 * @return	\gms\data\guild\Guild
	 */
	public function getGuild() {
		if ($this->guild === null) {
			$this->guild = new Guild($this->guildID);
		}

		return $this->guild;
	}

	/**
	 * Returns title of rank.
	 *
	 * @return    mixed|null
	 */
	public function getTitle() {
		return $this->name;
	}
}
