<?php
namespace gms\data\guild;
use wcf\data\search\ISearchResultObject;
use wcf\system\search\SearchResultTextParser;

/**
 * Represents a search result of guild.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2013 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.wcf.guild
 * @subpackage	data.guild
 * @category	Guilded 2.0
 */
class SearchResultGuild extends GuildProfile implements ISearchResultObject {
	/**
	 * @see	\wcf\data\search\ISearchResultObject::getFormattedMessage()
	 */
	public function getFormattedMessage() {
		return SearchResultTextParser::getInstance()->parse($this->description);
	}
	
	/**
	 * @see	\wcf\data\search\ISearchResultObject::getSubject()
	 */
	public function getSubject() {
		return $this->name;
	}
	
	/**
	 * @see	\wcf\data\search\ISearchResultObject::getLink()
	 */
	public function getLink($query = '') {
		return LinkHandler::getInstance()->getLink('Guild', array(
			'object' => $this->getDecoratedObject()
		));
	}
	
	/**
	 * @see	\wcf\data\search\ISearchResultObject::getTime()
	 */
	public function getTime() {
		return $this->time;
	}
	
	/**
	 * @see	\wcf\data\search\ISearchResultObject::getObjectTypeName()
	 */
	public function getObjectTypeName() {
		return 'com.guilded.wcf.guild';
	}
	
	/**
	 * @see	\wcf\data\search\ISearchResultObject::getContainerTitle()
	 */
	public function getContainerTitle() {
		return '';
	}
	
	/**
	 * @see	\wcf\data\search\ISearchResultObject::getContainerLink()
	 */
	public function getContainerLink() {
		return '';
	}
}
