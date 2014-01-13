<?php
namespace gms\system\event\view;

use wcf\data\user\User;

interface IEventView {
	/**
	 * Returns the number of items for view.
	 *
	 * @return	integer
	 */
	public function getNumberOfItems();

	/**
	 * Returns true if this menu item is accessible by current user.
	 *
	 * @return	boolean
	 */
	public function isAccessible();

	/**
	 * Returns content for this view.
	 *
	 * @return	string
	 */
	public function getContent();
}
