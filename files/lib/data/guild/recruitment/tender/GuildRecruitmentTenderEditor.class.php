<?php
namespace gms\data\guild\recruitment\tender;
use wcf\data\DatabaseObjectEditor;

/**
 * Editor for Recruitment tenders.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons <BY-NC-SA> (http://creativecommons.org/licenses/by-nc-sa/3.0/legalcode)
 * @package	com.guilded.gms
 * @subpackage	data.guild.recruitment.tender
 * @category	Guilded 2.0
 */
class GuildRecruitmentTenderEditor extends DatabaseObjectEditor {
	/**
	 * @see	\wcf\data\DatabaseObjectDecorator::$baseClass
	 */
	protected static $baseClass = 'gms\data\guild\recruitment\tender\GuildRecruitmentTender';

	/**
	 * Decrease open job positions.
	 */
	public function decrease() {
		$this->update(array(
			'quantity' => $this->quantity - 1
		));
	}
}
