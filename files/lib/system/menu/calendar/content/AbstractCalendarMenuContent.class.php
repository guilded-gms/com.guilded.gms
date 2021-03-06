<?php
namespace gms\system\menu\calendar\content;
use gms\data\event\date\EventDateList;
use wcf\system\event\EventHandler;
use wcf\system\SingletonFactory;
use wcf\system\WCF;

/**
 * Abstract implementation for Calendar Content.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @subpackage	system.menu.calendar.content
 * @category	Guilded 2.0
 */
class AbstractCalendarMenuContent extends SingletonFactory implements ICalendarMenuContent {
	/**
	 * template file
	 * @var	string
	 */
	protected $templateName = '';

	/**
	 * list of events
	 * @var	\gms\data\event\date\EventDateList
	 */
	protected $eventDateList = null;

	/**
	 * @see	\gms\system\menu\calendar\content\ICalendarMenuContent::setEventDates()
	 */
	public function setEventDates(EventDateList $eventDateList) {
		$this->eventDateList = $eventDateList;
	}

	/**
	 * Fetches data.
	 */
	public function fetch() {
		// fire listener
		EventHandler::getInstance()->fireAction($this, 'fetch');

		// read objects
		$this->eventDateList->readObjects();
	}

	/**
	 * @see	\wcf\system\menu\calendar\content\ICalendarMenuContent::getContent()
	 */
	public function getContent() {
		if (empty($this->templateName)) {
			return '';
		}

		$this->fetch();

		WCF::getTPL()->assign(array(
			'eventDates' => $this->eventDateList
		));
		
		return WCF::getTPL()->fetch($this->templateName, 'gms');
	}
}
