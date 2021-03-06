DROP TABLE IF EXISTS gms1_game;
CREATE TABLE gms1_game (
	gameID 			INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	packageID 		INT(10) NOT NULL,
	title 			VARCHAR(255) NOT NULL,
	level 			INT(10) DEFAULT 1,
	race 			INT(10) DEFAULT 1,
	class 			INT(10) DEFAULT 1,
	icon			VARCHAR(255) DEFAULT '',
	isEnabled		TINYINT(1) DEFAULT 1,
	UNIQUE KEY(title)
) ENGINE=INNODB CHARSET=utf8;

DROP TABLE IF EXISTS gms1_game_role;
CREATE TABLE gms1_game_role (
	roleID 			INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	packageID 		INT(10) NOT NULL,
	gameID 			INT(10) NOT NULL,
	identifier		VARCHAR(255),
	title		   VARCHAR(255),
	icon	   		VARCHAR(255),
	isEnabled		TINYINT(1) DEFAULT 1,
	UNIQUE KEY(gameID, title)
) ENGINE=INNODB CHARSET=utf8;

DROP TABLE IF EXISTS gms1_game_faction;
CREATE TABLE gms1_game_faction (
	factionID 		INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	packageID 		INT(10) NOT NULL,
	gameID 			INT(10) NOT NULL,
	identifier		VARCHAR(255),
	title		   VARCHAR(255),
	icon	   		VARCHAR(255),
	isEnabled		TINYINT(1) DEFAULT 1,
	UNIQUE KEY(gameID, title)
) ENGINE=INNODB CHARSET=utf8;

DROP TABLE IF EXISTS gms1_game_race;
CREATE TABLE gms1_game_race (
	raceID 			INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	packageID 		INT(10) NOT NULL,
	gameID 			INT(10) NOT NULL,
	identifier		VARCHAR(255),
	title		   VARCHAR(255),
	icon	   		VARCHAR(255),
	isEnabled		TINYINT(1) DEFAULT 1,
	parent			INT(10),
	UNIQUE KEY(gameID, title)
) ENGINE=INNODB CHARSET=utf8;

DROP TABLE IF EXISTS gms1_game_race_to_faction;
CREATE TABLE gms1_game_race_to_faction (
	raceID 			INT(10) NOT NULL,
	factionID		INT(10) NOT NULL,
	UNIQUE KEY(raceID, factionID)
) ENGINE=INNODB CHARSET=utf8;

DROP TABLE IF EXISTS gms1_game_classification;
CREATE TABLE gms1_game_classification (
	classificationID 		INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	packageID 				INT(10) NOT NULL,
	gameID 					INT(10) NOT NULL,
	identifier				VARCHAR(255),
	title		   			VARCHAR(255),
	icon	   				VARCHAR(255),
	isEnabled				TINYINT(1) DEFAULT 1,
	parent					INT(10),
	UNIQUE KEY(gameID, title)
) ENGINE=INNODB CHARSET=utf8;

DROP TABLE IF EXISTS gms1_game_classification_to_race;
CREATE TABLE gms1_game_classification_to_race (
	classificationID 	INT(10) NOT NULL,
	raceID 				INT(10) NOT NULL,
	UNIQUE KEY(classificationID, raceID)
) ENGINE=INNODB CHARSET=utf8;

DROP TABLE IF EXISTS gms1_game_classification_to_role;
CREATE TABLE gms1_game_classification_to_role (
	classificationID 	INT(10) NOT NULL,
	roleID 				INT(10) NOT NULL,
	UNIQUE KEY(classificationID, roleID)
) ENGINE=INNODB CHARSET=utf8;

-- @todo pip
DROP TABLE IF EXISTS gms1_game_instance;
CREATE TABLE gms1_game_instance (
	instanceID 		INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	packageID 		INT(10) NOT NULL,
	gameID 			INT(10) NOT NULL,
	identifier		VARCHAR(255),
	title		   	VARCHAR(255),
	icon	   		VARCHAR(255),
	difficulty		VARCHAR(255),
	isEnabled		TINYINT(1) DEFAULT 1,
	UNIQUE KEY(gameID, title)
) ENGINE=INNODB CHARSET=utf8;

-- @todo pip
DROP TABLE IF EXISTS gms1_game_combatant;
CREATE TABLE gms1_game_combatant (
	combatantID 	INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	packageID 		INT(10) NOT NULL,
	gameID 			INT(10) NOT NULL,
	instanceID		INT(10) NOT NULL,
	identifier		VARCHAR(255),
	title			VARCHAR(255),
	icon	   		VARCHAR(255),
	isEnabled		TINYINT(1) DEFAULT 1,
	UNIQUE KEY(gameID, title)
) ENGINE=INNODB CHARSET=utf8;

-- @todo pip
DROP TABLE IF EXISTS gms1_game_talent;
CREATE TABLE gms1_game_talent (
	talentID 		INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	packageID 		INT(10) NOT NULL,
	gameID 			INT(10) NOT NULL,
	classificationID			INT(10) NOT NULL,
	identifier		VARCHAR(255),
	title			VARCHAR(255),
	icon	   		VARCHAR(255),
	isEnabled		TINYINT(1) DEFAULT 1,
	UNIQUE KEY(gameID, title)
) ENGINE=INNODB CHARSET=utf8;

DROP TABLE IF EXISTS gms1_game_item;
CREATE TABLE gms1_game_item (
	itemID 			INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	gameID 			INT(10) NOT NULL,
	externalID		VARCHAR(255),
	languageID		INT(10) NOT NULL,
	additionalData	TEXT,
	UNIQUE KEY(gameID, externalID, languageID)
) ENGINE=INNODB CHARSET=utf8;

DROP TABLE IF EXISTS gms1_game_server;
CREATE TABLE gms1_game_server (
	serverID 			INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	gameID 				INT(10) NOT NULL,
	name				VARCHAR(255),
	status				VARCHAR(55),
	type				VARCHAR(55),
	population			INT(10) DEFAULT NULL,
	queue				TINYINT(1) DEFAULT 0,
	isOnline			TINYINT(1) DEFAULT 1,
	UNIQUE KEY(gameID, name)
) ENGINE=INNODB CHARSET=utf8;

DROP TABLE IF EXISTS gms1_character_profile_menu_item;
CREATE TABLE gms1_character_profile_menu_item (
	menuItemID			INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	packageID			INT(10) NOT NULL,
	menuItem 			VARCHAR(255) NOT NULL,
	showOrder 			INT(10) NOT NULL DEFAULT 0,
	permissions 		TEXT NULL,
	options 			TEXT NULL,
	className 			VARCHAR(255) NOT NULL,
	UNIQUE KEY (packageID, menuItem)
) ENGINE=INNODB CHARSET=utf8;

DROP TABLE IF EXISTS gms1_guild_profile_menu_item;
CREATE TABLE gms1_guild_profile_menu_item (
	menuItemID			INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	packageID 			INT(10) NOT NULL,
	menuItem 			VARCHAR(255) NOT NULL,
	showOrder 			INT(10) NOT NULL DEFAULT 0,
	permissions 		TEXT NULL,
	options 			TEXT NULL,
	className 			VARCHAR(255) NOT NULL,
	UNIQUE KEY (packageID, menuItem)
) ENGINE=INNODB CHARSET=utf8;

DROP TABLE IF EXISTS gms1_alliance;
CREATE TABLE gms1_alliance (
	allianceID			INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	gameID				INT(10) NOT NULL,
	name				VARCHAR(255) NOT NULL
) ENGINE=INNODB CHARSET=utf8;

DROP TABLE IF EXISTS gms1_alliance_to_guild;
CREATE TABLE gms1_alliance_to_guild(
	allianceID			INT(10) NOT NULL,
	guildID				INT(10) NOT NULL,
	UNIQUE KEY(allianceID, guildID)
) ENGINE=INNODB CHARSET=utf8;

DROP TABLE IF EXISTS gms1_alliance_to_character;
CREATE TABLE gms1_alliance_to_character(
	allianceID			INT(10) NOT NULL,
	characterID			INT(10) NOT NULL,
	UNIQUE KEY(allianceID, characterID)
) ENGINE=INNODB CHARSET=utf8;

DROP TABLE IF EXISTS gms1_guild;
CREATE TABLE gms1_guild (
	guildID				INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	gameID				INT(10) NOT NULL,
	name	 			VARCHAR(255) NOT NULL,
	groupID				INT(10) DEFAULT NULL,
	isPublic			TINYINT(1) DEFAULT 0
) ENGINE=INNODB CHARSET=utf8;

DROP TABLE IF EXISTS gms1_guild_option;
CREATE TABLE gms1_guild_option  (
	optionID			INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	packageID			INT(10) NOT NULL,
	optionName			VARCHAR(255) NOT NULL DEFAULT '',
	categoryName		VARCHAR(255) NOT NULL DEFAULT '',
	optionType			VARCHAR(255) NOT NULL DEFAULT '',
	defaultValue		MEDIUMTEXT,
	validationPattern	TEXT,
	selectOptions		MEDIUMTEXT,
	enableOptions		MEDIUMTEXT,
	required			TINYINT(1) DEFAULT 0,
	disabled			TINYINT(1) DEFAULT 0,
	showOrder			INT(10) NOT NULL DEFAULT 0,
	permissions			TEXT,
	options				TEXT,
	outputClass			VARCHAR(255) DEFAULT '',
	additionalData		MEDIUMTEXT,
	UNIQUE KEY optionName (optionName)
) ENGINE=INNODB CHARSET=utf8;

DROP TABLE IF EXISTS gms1_guild_option_category;
CREATE TABLE gms1_guild_option_category (
	categoryID			INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	packageID			INT(10) NOT NULL,
	categoryName		VARCHAR(255) NOT NULL DEFAULT '',
	parentCategoryName	VARCHAR(255) NOT NULL DEFAULT '',
	showOrder			INT(10) NOT NULL DEFAULT 0,
	permissions			TEXT,
	options				TEXT,
	UNIQUE KEY categoryName (categoryName)
) ENGINE=INNODB CHARSET=utf8;

DROP TABLE IF EXISTS gms1_guild_option_value;
CREATE TABLE gms1_guild_option_value  (
	guildID 			INT(10) NOT NULL,
	optionID			INT(10) NOT NULL,
	optionValue			MEDIUMTEXT NOT NULL,
	UNIQUE KEY guildID (guildID, optionID)
) ENGINE=INNODB CHARSET=utf8;

DROP TABLE IF EXISTS gms1_guild_activity;
CREATE TABLE gms1_guild_activity (
	activityID			INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	guildID 			INT(10) NOT NULL,
	time				INT(10) NOT NULL,
	activityName		VARCHAR(255) NOT NULL,
	additionalData		MEDIUMTEXT
);

DROP TABLE IF EXISTS gms1_character;
CREATE TABLE gms1_character (
	characterID			INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	gameID				INT(10) NOT NULL,
	guildID 			INT(10) DEFAULT NULL,
	userID	 			INT(10) NOT NULL,
	username			VARCHAR(255),
	name		  		VARCHAR(255) NOT NULL,
	time 				INT(10) DEFAULT 0,
	isPrimary			TINYINT(1) DEFAULT 0
) ENGINE=INNODB CHARSET=utf8;

DROP TABLE IF EXISTS gms1_guild_rank;
CREATE TABLE gms1_guild_rank (
	rankID				INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	guildID				INT(10) DEFAULT NULL,
	name		  		VARCHAR(255) NOT NULL,
	isDefault			TINYINT(1) DEFAULT 0
) ENGINE=INNODB CHARSET=utf8;

DROP TABLE IF EXISTS gms1_character_option;
CREATE TABLE gms1_character_option  (
	optionID			INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	packageID			INT(10) NOT NULL,
	optionName			VARCHAR(255) NOT NULL DEFAULT '',
	categoryName		VARCHAR(255) NOT NULL DEFAULT '',
	optionType			VARCHAR(255) NOT NULL DEFAULT '',
	defaultValue		MEDIUMTEXT,
	validationPattern	TEXT,
	selectOptions		MEDIUMTEXT,
	enableOptions		MEDIUMTEXT,
	required			TINYINT(1) DEFAULT 0,
	disabled			TINYINT(1) DEFAULT 0,
	showOrder			INT(10) NOT NULL DEFAULT 0,
	permissions			TEXT,
	options				TEXT,
	outputClass			VARCHAR(255) DEFAULT '',
	additionalData		MEDIUMTEXT,
	UNIQUE KEY optionName (optionName)
) ENGINE=INNODB CHARSET=utf8;

DROP TABLE IF EXISTS gms1_character_option_category;
CREATE TABLE gms1_character_option_category (
	categoryID			INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	packageID			INT(10) NOT NULL,
	categoryName		VARCHAR(255) NOT NULL DEFAULT '',
	parentCategoryName	VARCHAR(255) NOT NULL DEFAULT '',
	showOrder			INT(10) NOT NULL DEFAULT 0,
	permissions			TEXT,
	options				TEXT,
	UNIQUE KEY categoryName (categoryName)
) ENGINE=INNODB CHARSET=utf8;

DROP TABLE IF EXISTS gms1_character_option_value;
CREATE TABLE gms1_character_option_value  (
	characterID 		INT(10) NOT NULL,
	optionID 			INT(10) NOT NULL,
	optionValue			MEDIUMTEXT,
	UNIQUE KEY characterID (characterID, optionID)
) ENGINE=INNODB CHARSET=utf8;

DROP TABLE IF EXISTS gms1_character_activity;
CREATE TABLE gms1_character_activity (
	activityID			INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	characterID 		INT(10) NOT NULL,
	time				INT(10) NOT NULL,
	languageItemName	VARCHAR(255) NOT NULL,
	additionalData		MEDIUMTEXT
) ENGINE=INNODB CHARSET=utf8;

-- character groups (e.g. raid group, battle groups, ..)
DROP TABLE IF EXISTS gms1_character_group;
CREATE TABLE gms1_character_group (
	groupID				INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	guildID				INT(10) DEFAULT NULL,
	name				VARCHAR(255) NOT NULL
) ENGINE=INNODB CHARSET=utf8;

DROP TABLE IF EXISTS gms1_character_group_to_character;
CREATE TABLE gms1_character_group_to_character(
	groupID				INT(10) NOT NULL,
	characterID			INT(10) NOT NULL,
	UNIQUE KEY(groupID, characterID)
) ENGINE=INNODB CHARSET=utf8;

DROP TABLE IF EXISTS gms1_guild_recruitment_tender;
CREATE TABLE gms1_guild_recruitment_tender(
	tenderID			INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	gameID				INT(10) NOT NULL,
	guildID				INT(10) NOT NULL,
	classificationID	INT(10) NOT NULL,
	roleID				INT(10) DEFAULT 0,
	talentID			INT(10) DEFAULT 0,
	quantity			INT(10),
	sortOrder			INT(10) DEFAULT 0,
	priority			TINYINT(1),
	UNIQUE KEY(guildID, classificationID, roleID, talentID)
) ENGINE=INNODB CHARSET=utf8;

DROP TABLE IF EXISTS gms1_guild_recruitment_application;
CREATE TABLE gms1_guild_recruitment_application(
	applicationID		INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	tenderID			INT(10),
	userID		 	 	INT(10) NOT NULL,
	characterID	 		INT(10) NOT NULL,
	guildID				INT(10) NOT NULL,
	subject		 		VARCHAR(255),
	text				TEXT,
	time				INT(10),
	isAccepted			TINYINT(1) DEFAULT 0,
	isDeclined			TINYINT(1) DEFAULT 0,
	statusTime			INT(10)
) ENGINE=INNODB CHARSET=utf8;

DROP TABLE IF EXISTS gms1_guild_recruitment_option;
CREATE TABLE gms1_guild_recruitment_option  (
	optionID			INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	packageID			INT(10) NOT NULL,
	optionName			VARCHAR(255) NOT NULL DEFAULT '',
	categoryName		VARCHAR(255) NOT NULL DEFAULT '',
	optionType			VARCHAR(255) NOT NULL DEFAULT '',
	defaultValue		MEDIUMTEXT,
	validationPattern	TEXT,
	enableOptions		MEDIUMTEXT,
	showOrder			INT(10) NOT NULL DEFAULT 0,
	permissions			TEXT,
	options				TEXT,
	additionalData		MEDIUMTEXT,
	UNIQUE KEY optionName (optionName)
) ENGINE=INNODB CHARSET=utf8;

DROP TABLE IF EXISTS gms1_guild_recruitment_option_category;
CREATE TABLE gms1_guild_recruitment_option_category (
	categoryID			INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	packageID			INT(10) NOT NULL,
	categoryName		VARCHAR(255) NOT NULL DEFAULT '',
	parentCategoryName	VARCHAR(255) NOT NULL DEFAULT '',
	showOrder			INT(10) NOT NULL DEFAULT 0,
	permissions			TEXT,
	options				TEXT,
	UNIQUE KEY categoryName (categoryName)
) ENGINE=INNODB CHARSET=utf8;

DROP TABLE IF EXISTS gms1_guild_recruitment_option_value;
CREATE TABLE gms1_guild_recruitment_option_value  (
	characterID			INT(10) NOT NULL,
	optionID			INT(10) NOT NULL,
	optionValue			MEDIUMTEXT NOT NULL,
	UNIQUE KEY characterID (characterID, optionID)
) ENGINE=INNODB CHARSET=utf8;

DROP TABLE IF EXISTS gms1_event;
CREATE TABLE gms1_event(
	eventID				INT(10) AUTO_INCREMENT PRIMARY KEY,
	categoryID			INT(10) DEFAULT NULL,
	objectTypeID		INT(10),	-- com.guilded.gms.event.type
	userID				INT(10),
	title				VARCHAR(255),
	description			VARCHAR(255),
	startTime			INT(10),
	endTime				INT(10),
	deadlineTime		INT(10),
	repeatDaily			INT(10),
	repeatWeekly		INT(10),
	repeatMonthly		INT(10),
	isClosed			TINYINT(1) DEFAULT 0,
	additionalData		TEXT
) ENGINE=INNODB CHARSET=utf8;

DROP TABLE IF EXISTS gms1_event_date;
CREATE TABLE gms1_event_date(
	dateID			INT(10) AUTO_INCREMENT PRIMARY KEY,
	eventID			INT(10) NOT NULL,
	title			VARCHAR(255),
	description		VARCHAR(255),
	startTime		INT(10),
	endTime			INT(10),
	deadlineTime	INT(10),
	isClosed		TINYINT(1) DEFAULT 0,
	additionalData	TEXT
) ENGINE=INNODB CHARSET=utf8;

-- participants
DROP TABLE IF EXISTS gms1_event_date_participation;
CREATE TABLE gms1_event_date_participation(
	participationID		INT(10) AUTO_INCREMENT PRIMARY KEY,
	eventDateID			INT(10) NOT NULL,
	userID				INT(10) NOT NULL,
	characterID			INT(10),
	time				INT(10),
	statusTime			INT(10),	-- last status update
	status				INT(10) DEFAULT 0,
	message 			VARCHAR(255),
	isConfirmed			TINYINT(1) DEFAULT 0,
	isQueued			TINYINT(1) DEFAULT 0,
	UNIQUE KEY(eventDateID, userID, characterID)
) ENGINE=INNODB CHARSET=utf8;

-- invitation
DROP TABLE IF EXISTS gms1_event_date_invitation;
CREATE TABLE gms1_event_date_invitation(
	invitationID		INT(10) AUTO_INCREMENT PRIMARY KEY,
	participationID		INT(10) NOT NULL,
	senderID			INT(10) NOT NULL,
	userID				INT(10) NOT NULL,
	characterID			INT(10) DEFAULT NULL,
	time 				INT(10)
) ENGINE=INNODB CHARSET=utf8;

DROP TABLE IF EXISTS gms1_object_credit;
CREATE TABLE gms1_object_credit (
	creditID			INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	objectTypeID		INT(10) NOT NULL,
	objectID			INT(10) NOT NULL,
	userID				INT(10) NOT NULL,
	characterID			INT(10) DEFAULT NULL,
	time				INT(10) NOT NULL DEFAULT 0,
	creditValue			NUMERIC(14,2),
	reason				VARCHAR(255),
	UNIQUE KEY (objectTypeID, objectID, userID, characterID),
	KEY (userID, time)
) ENGINE=INNODB CHARSET=utf8;

-- calendar menu
DROP TABLE IF EXISTS gms1_calendar_menu_item;
CREATE TABLE gms1_calendar_menu_item (
	menuItemID			INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	packageID			INT(10) NOT NULL,
	menuItem 			VARCHAR(255) NOT NULL,
	showOrder 			INT(10) NOT NULL DEFAULT 0,
	permissions 		TEXT NULL,
	options 			TEXT NULL,
	className 			VARCHAR(255) NOT NULL,
	UNIQUE KEY (packageID, menuItem)
) ENGINE=INNODB CHARSET=utf8;

-- foreign keys
ALTER TABLE gms1_game_role ADD FOREIGN KEY (gameID) REFERENCES gms1_game (gameID) ON DELETE CASCADE;

ALTER TABLE gms1_game_faction ADD FOREIGN KEY (gameID) REFERENCES gms1_game (gameID) ON DELETE CASCADE;

ALTER TABLE gms1_game_race ADD FOREIGN KEY (gameID) REFERENCES gms1_game (gameID) ON DELETE CASCADE;

ALTER TABLE gms1_game_race_to_faction ADD FOREIGN KEY (raceID) REFERENCES gms1_game_race (raceID) ON DELETE CASCADE;
ALTER TABLE gms1_game_race_to_faction ADD FOREIGN KEY (factionID) REFERENCES gms1_game_faction (factionID) ON DELETE CASCADE;

ALTER TABLE gms1_game_classification ADD FOREIGN KEY (gameID) REFERENCES gms1_game (gameID) ON DELETE CASCADE;

ALTER TABLE gms1_game_classification_to_race ADD FOREIGN KEY (classificationID) REFERENCES gms1_game_classification (classificationID) ON DELETE CASCADE;
ALTER TABLE gms1_game_classification_to_race ADD FOREIGN KEY (raceID) REFERENCES gms1_game_race (raceID) ON DELETE CASCADE;

ALTER TABLE gms1_game_classification_to_role ADD FOREIGN KEY (classificationID) REFERENCES gms1_game_classification (classificationID) ON DELETE CASCADE;
ALTER TABLE gms1_game_classification_to_role ADD FOREIGN KEY (roleID) REFERENCES gms1_game_role (roleID) ON DELETE CASCADE;

ALTER TABLE gms1_game_instance ADD FOREIGN KEY (gameID) REFERENCES gms1_game (gameID) ON DELETE CASCADE;

ALTER TABLE gms1_game_combatant ADD FOREIGN KEY (gameID) REFERENCES gms1_game (gameID) ON DELETE CASCADE;
ALTER TABLE gms1_game_combatant ADD FOREIGN KEY (instanceID) REFERENCES gms1_game_instance (instanceID) ON DELETE CASCADE;

ALTER TABLE gms1_game_talent ADD FOREIGN KEY (gameID) REFERENCES gms1_game (gameID) ON DELETE CASCADE;
ALTER TABLE gms1_game_talent ADD FOREIGN KEY (classificationID) REFERENCES gms1_game_classification (classificationID) ON DELETE CASCADE;

ALTER TABLE gms1_game_item ADD FOREIGN KEY (gameID) REFERENCES gms1_game (gameID) ON DELETE CASCADE;

ALTER TABLE gms1_game_server ADD FOREIGN KEY (gameID) REFERENCES gms1_game (gameID) ON DELETE CASCADE;

ALTER TABLE gms1_guild ADD FOREIGN KEY (gameID) REFERENCES gms1_game (gameID) ON DELETE CASCADE;
ALTER TABLE gms1_guild ADD FOREIGN KEY (groupID) REFERENCES wcf1_user_group (groupID) ON DELETE SET NULL;

ALTER TABLE gms1_character ADD FOREIGN KEY (userID) REFERENCES wcf1_user (userID) ON DELETE CASCADE;
ALTER TABLE gms1_character ADD FOREIGN KEY (gameID) REFERENCES gms1_game (gameID) ON DELETE CASCADE;
ALTER TABLE gms1_character ADD FOREIGN KEY (guildID) REFERENCES gms1_guild (guildID) ON DELETE SET NULL;

ALTER TABLE gms1_character_option_value ADD FOREIGN KEY (characterID) REFERENCES gms1_character (characterID) ON DELETE CASCADE;
ALTER TABLE gms1_character_option_value ADD FOREIGN KEY (optionID) REFERENCES gms1_character_option (optionID) ON DELETE CASCADE;

ALTER TABLE gms1_guild_rank ADD FOREIGN KEY (guildID) REFERENCES gms1_guild (guildID) ON DELETE CASCADE;

ALTER TABLE gms1_guild_recruitment_application ADD FOREIGN KEY (tenderID) REFERENCES gms1_guild_recruitment_tender (tenderID) ON DELETE SET NULL;
ALTER TABLE gms1_guild_recruitment_application ADD FOREIGN KEY (userID) REFERENCES wcf1_user (userID) ON DELETE CASCADE;
ALTER TABLE gms1_guild_recruitment_application ADD FOREIGN KEY (characterID) REFERENCES gms1_character (characterID) ON DELETE CASCADE;
ALTER TABLE gms1_guild_recruitment_application ADD FOREIGN KEY (guildID) REFERENCES gms1_guild (guildID) ON DELETE CASCADE;

ALTER TABLE gms1_event_date ADD FOREIGN KEY (eventID) REFERENCES gms1_event (eventID) ON DELETE CASCADE;

ALTER TABLE gms1_event_date_participation ADD FOREIGN KEY (eventDateID) REFERENCES gms1_event_date (dateID) ON DELETE CASCADE;
ALTER TABLE gms1_event_date_participation ADD FOREIGN KEY (userID) REFERENCES wcf1_user (userID) ON DELETE CASCADE;
ALTER TABLE gms1_event_date_participation ADD FOREIGN KEY (characterID) REFERENCES gms1_character (characterID) ON DELETE CASCADE;

ALTER TABLE gms1_object_credit ADD FOREIGN KEY (objectTypeID) REFERENCES wcf1_object_type (objectTypeID) ON DELETE CASCADE;
ALTER TABLE gms1_object_credit ADD FOREIGN KEY (userID) REFERENCES wcf1_user (userID) ON DELETE CASCADE;
ALTER TABLE gms1_object_credit ADD FOREIGN KEY (characterID) REFERENCES gms1_character (characterID) ON DELETE CASCADE;