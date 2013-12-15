<?php
namespace gms\system\option;
use wcf\data\option\Option;
use wcf\system\WCF;

/**
 * Select Option for game-classes.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2013 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	system.option
 * @category	Guilded 2.0
*/
class GameClassSelectOptionType extends SelectOptionType {
	protected $gameID = 0;

	/**
	 * Get possible select-options.
	 *
	 * @todo set gameID
	 */
	public function parseSelectOptions(){
		$result = array();
		
		$sql = "SELECT  
					classID, title
				FROM wcf".WCF_N."_game_class
				WHERE	(gameID = ?)";
		$statement = WCF::getDB()->prepareStatement($sql);
		$statement->execute(array($this->gameID));
		
		while($row = $statement->fetchArray()){
			$result[$row['classID']] = WCF::getLanguage()->get('gms.game.' . $row['title'] . '.title');
		}
		
		return $result;
	}
}
