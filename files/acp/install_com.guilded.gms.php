<?php
use wcf\data\package\update\server\PackageUpdateServerAction;
use wcf\data\user\group\UserGroup;
use wcf\system\dashboard\DashboardHandler;
use wcf\system\WCF;

/**
 * Install script.
 *
 * @author	Jeffrey Reichardt
 * @copyright	2012-2014 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @category	Guilded 2.0
 */

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

// set default values for dashboard boxes
DashboardHandler::setDefaultValues('com.guilded.gms.GuildPage', array(
	'com.guilded.gms.game.serverStatus' => 1,
	'com.guilded.gms.guild.recruitment' => 2
));

// set permissions for super moderator
$group = new UserGroup(6);
if ($group->groupID) {
	$sql = "INSERT IGNORE INTO 	wcf".WCF_N."_user_group_option_value (groupID, optionID, optionValue)
			SELECT	6, optionID, 1
			FROM	wcf".WCF_N."_user_group_option
			WHERE	(optionName LIKE 'mod.gms.%')";
	$statement = WCF::getDB()->prepareStatement($sql);
	$statement->execute();
}

// add Guilded package server
$serverURL = 'http://update.guilded.de/stormrage/'; // @todo validate url

// check if update server exists
$sql = "SELECT	packageUpdateServerID
		FROM	wcf".WCF_N."_package_update_server
		WHERE	serverURL = ?";
$statement = WCF::getDB()->prepareStatement($sql);
$statement->execute(array($serverURL));
$row = $statement->fetchArray();

if (!$row) {
	// create package server
	$objectAction = new PackageUpdateServerAction(array(), 'create', array('data' => array(
		'serverURL' => $serverURL
	)));
	$objectAction->executeAction();

	// check for updates
	$objectAction = new PackageUpdateServerAction(array(), 'searchForUpdates', array(
		'ignoreCache' => true
	));
	$objectAction->executeAction();
}
