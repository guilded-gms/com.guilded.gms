<?php
namespace gms\system\event\view;
use wcf\system\event\view\IEventView;
use wcf\util\StringUtil;

abstract class AbstractEventView implements IEventView {
	/**
	 * template name for output
	 * @var string
	 */
	protected $templateName = '';

	/**
	 * event type for view
	 * @var 
	 */
	protected $eventType = null; 

	public function __construct(EventType $type) {
		$this->setEventType($type);
	}

	public function setEventType(EventType $type) {
		$this->eventType = &$type;
	}

	/** 
	 * Returns event type of view
	 */
	public function getEventType() {
		return $this->eventType;
	}
	
	/**
	 * @see IEventView::getIdentifier()
	 */
	public function getIdentifier() {
		return StringUtil::firstCharToLowerCase(get_called_class());
	}
	
	/**
	 * @see IEventView::getOutput()
	 */
	public function getContent() {
		if (empty($this->templateName)) {
			return '';
		}
		
		WCF::getTPL()->assign(array(
			'eventList' => $this->getEventType()->getEvents()
		));
	
		return WCF::getTpl()->fetch($this->templateName);
	}
}
