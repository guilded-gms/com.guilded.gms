<?php
namespace gms\system\event\view;

class ListEventView extends AbstractEventView {
	protected $templateName = 'eventViewList';

	/**
	 * @see AbstractEventView::__construct()
	 */
	public function __construct(EventType $type){
		parent::__construct($type);

		//$this->getEventType()->getEventList()->getConditionBuilder()->add('eventTypeID = ?', '12345');
	}
}
