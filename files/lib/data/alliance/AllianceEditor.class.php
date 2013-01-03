<?php
namespace wcf\data\alliance;
use wcf\data\DatabaseObjectEditor;
use wcf\system\WCF;

/**
 * The alliance editor
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2013 DevLabor UG (haftungsbeschränkt)
 * @license	CC BY-NC-SA 3.0 <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.wcf.character
 * @subpackage	data.alliance
 * @category	Guilded 2.0
*/
class AllianceEditor extends DatabaseObjectEditor {
	/**
	 * @see	wcf\data\DatabaseObjectDecorator::$baseClass
	 */
	protected static $baseClass = 'wcf\data\alliance\Alliance';
}
