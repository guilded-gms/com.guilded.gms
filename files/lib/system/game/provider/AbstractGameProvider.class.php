<?php
namespace gms\system\game\provider;
use wcf\system\exception\SystemException;
use wcf\util\FileUtil;
use wcf\util\HTTPRequest;
use wcf\util\JSON;

/**
 * Abstract implementation for game data provider.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	system.game.provider
 * @category	Guilded 2.0
*/
abstract class AbstractGameProvider implements IGameProvider {
	/**
	 * Base url for data provider.
	 * @var	string
	 */
	protected $baseUrl = '';
	
	/**
	 * Holds data from provider.
	 * @var	array
	 */
	protected $data = array();

	/**
	 * @see	\wcf\system\game\provider\IGameProvider::getServer()
	 */
	public abstract function getServer($name);
	
	/**
	 * @see	\wcf\system\game\provider\IGameProvider::getCharacter()
	 */
	public abstract function getCharacter($server, $name);
	
	/**
	 * @see	\wcf\system\game\provider\IGameProvider::getGuild()
	 */
	public abstract function getGuild($server, $name);
	
	/**
	 * @see	\wcf\system\game\provider\IGameProvider::getItem()
	 */
	public abstract function getItem($itemID);

	/**
	 * Builds url upon given route and query.
	 *
	 * @param	array	$route
	 * @param	array	$queries
	 * @return	string
	 */
	protected function buildURL($route = array(), $queries = array()) {
		$url = $this->baseUrl;

		//add paths
		foreach ($route as $item) {
			$url .= FileUtil::addLeadingSlash(urlencode($item));
		}

		//add queries
		if (!empty($queries)) {
			$url .= '?'.http_build_query($queries);
		}

		return $url;
	}

	/**
	 * Gets data from given route and query.
	 *
	 * @param	array	$route
	 * @param	array	$queries
	 * @return	array
	 */
	public function getData($route = array(), $queries = array()) {
		$url = $this->buildURL($route, $queries);
		$this->sendRequest($url);
		
		return $this->data;
	}

	/**
	 * Sending request and sets response data.
	 *
	 * @param	string	$url
	 * @throws	\wcf\system\exception\SystemException
	 */
	protected function sendRequest($url) {
		// reset actual data
		$this->data = array();
	
		$request = new HTTPRequest($url);
		$request->execute();

		$reply = $request->getReply();
		$response = $reply['body'];

		if (empty($response)) {
			throw new SystemException("No response from given URL: " . $url);
		}

		$this->data = $response;
	}
}
