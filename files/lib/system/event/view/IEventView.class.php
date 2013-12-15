<?php
namespace gms\system\event\view;

interface IEventView {
	/**
	 * Name of template
	 * @var string
	 */
	protected $templateName = '';
	
	/**
	 * Returns identifier of view
	 *
	 * @return	string
	 */
	public function getIdentifier();
	
	/**
	 * Fetches template and returns content.
	 *
	 * @return	string
	 */
	public function getContent();
}
