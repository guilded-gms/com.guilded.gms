<?php
namespace gms\system\event\type;

interface IEventType {
	/**
	 * Returns title of the type.
	 */	
	public function getTitle();
	
	/**
	 * Returns name of icon.
	 */	
	public function getIcon();
}
