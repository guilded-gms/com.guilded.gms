<?php
use wcf\data\guild\GuildEditor;
use wcf\system\WCF;

// set install date
$sql = "UPDATE	wcf".WCF_N."_option
		SET		optionValue = ?
		WHERE	optionName = ?";
$statement = WCF::getDB()->prepareStatement($sql);
$statement->execute(array(TIME_NOW, 'gms_install_date'));

// set page title
if (!defined('PAGE_TITLE') || !PAGE_TITLE) {
	$sql = "UPDATE	wcf".WCF_N."_option
			SET		optionValue = ?
			WHERE	optionName = ?";
	$statement = WCF::getDB()->prepareStatement($sql);
	$statement->execute(array('Guilded 2.0', 'page_title'));
}

// @todo set up dashboard boxes
// @todo set mod permissions
