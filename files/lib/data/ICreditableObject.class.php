<?phpnamespace gms\data;use wcf\data\DatabaseObject;/** * All creditable objects must implement this interface *  * @author	Jeffrey Reichardt * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt) * @license	CC BY-NC-SA 3.0 <http://creativecommons.org/licenses/by-nc-sa/3.0/deed> * @package	com.guilded.gms * @subpackage	data * @category	Guilded 2.0 */interface ICreditableObject {	/**	 * Returns short output of CreditableObject	 *	 * @return	string	 */	public function getShortOutput();	/**	 * Returns output of CreditableObject	 *	 * @return	string	 */	public function getOutput();	/**	 * Sets object data.	 *	 * @param	\wcf\data\DatabaseObject	$object	 */	public function setObject(DatabaseObject $object);	/**	 * Returns object	 *	 * @return \wcf\data\DatabaseObject	 */	public function getObject();}