<?php
namespace gms\system\event\view;
use wcf\system\event\view\AbstractEventView;

class MonthEventView extends AbstractEventView {
	protected $templateName = 'eventViewMonth';

	/**
	 * @see AbstractEventView::__construct()
	 */
	public function __construct(EventType $type) {
		parent::__construct($type);

		// \todo get selected month
		
		$this->getEventType()->getEventList()->getConditionBuilder()->add('event.start BETWEEN ? AND ?', array(MONTHBEGIN, MONTHEND));
	}
}
