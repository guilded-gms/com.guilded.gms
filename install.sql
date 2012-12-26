-- character profile menu
DROP TABLE IF EXISTS wcf1_character_profile_menu_item;
CREATE TABLE wcf1_character_profile_menu_item (
	menuItemID			INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	packageID			INT(10) NOT NULL,
	menuItem 			VARCHAR(255) NOT NULL,
	showOrder 			INT(10) NOT NULL DEFAULT 0,
	permissions 		TEXT NULL,
	options 			TEXT NULL,
	className 			VARCHAR(255) NOT NULL,
	UNIQUE KEY (packageID, menuItem)
);

-- guild profile menu
DROP TABLE IF EXISTS wcf1_guild_profile_menu_item;
CREATE TABLE wcf1_guild_profile_menu_item (
	menuItemID			INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	packageID 			INT(10) NOT NULL,
	menuItem 			VARCHAR(255) NOT NULL,
	showOrder 			INT(10) NOT NULL DEFAULT 0,
	permissions 		TEXT NULL,
	options 			TEXT NULL,
	className 			VARCHAR(255) NOT NULL,
	UNIQUE KEY (packageID, menuItem)
);

-- alliance
DROP TABLE IF EXISTS wcf1_alliance;
CREATE TABLE wcf1_alliance (
	allianceID			INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	gameID				INT(10) NOT NULL,
	name				VARCHAR(255) NOT NULL		
);

DROP TABLE IF EXISTS wcf1_alliance_to_guild;
CREATE TABLE wcf1_alliance_to_guild(
	allianceID			INT(10) NOT NULL,
	guildID				INT(10) NOT NULL,
	UNIQUE KEY(allianceID, guildID)
);

DROP TABLE IF EXISTS wcf1_alliance_to_character;
CREATE TABLE wcf1_alliance_to_character(
	allianceID			INT(10) NOT NULL,
	characterID			INT(10) NOT NULL,
	UNIQUE KEY(allianceID, characterID)
);

-- guild
DROP TABLE IF EXISTS wcf1_guild;
CREATE TABLE wcf1_guild (
	guildID			INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	gameID			INT(10) NOT NULL,
	name	 		VARCHAR(255) NOT NULL
);

DROP TABLE IF EXISTS wcf1_guild_option;
CREATE TABLE wcf1_guild_option  (
	optionID INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	optionName VARCHAR(255) NOT NULL DEFAULT '',
	categoryName VARCHAR(255) NOT NULL DEFAULT '',
	optionType VARCHAR(255) NOT NULL DEFAULT '',
	defaultValue MEDIUMTEXT,
	validationPattern TEXT,
	enableOptions MEDIUMTEXT,
	showOrder INT(10) NOT NULL DEFAULT 0,
	permissions TEXT,
	options TEXT,
	additionalData MEDIUMTEXT,
	UNIQUE KEY optionName (optionName)
);

DROP TABLE IF EXISTS wcf1_guild_option_category;
CREATE TABLE wcf1_guild_option_category (
	categoryID INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	categoryName VARCHAR(255) NOT NULL DEFAULT '',
	parentCategoryName VARCHAR(255) NOT NULL DEFAULT '',
	showOrder INT(10) NOT NULL DEFAULT 0,
	permissions TEXT,
	options TEXT,
	UNIQUE KEY categoryName (categoryName)
);

DROP TABLE IF EXISTS wcf1_guild_option_value;
CREATE TABLE wcf1_guild_option_value  (
	guildID INT(10) NOT NULL,
	optionID INT(10) NOT NULL,
	optionValue MEDIUMTEXT NOT NULL,
	UNIQUE KEY guildID (guildID, optionID)
);

-- guild activity
DROP TABLE IF EXISTS wcf1_guild_activity;
CREATE TABLE wcf1_guild_activity (
	activityID		INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	guildID INT(10) NOT NULL,	
	time			INT(10) NOT NULL,
	activityName	VARCHAR(255) NOT NULL,
	additionalData	MEDIUMTEXT
);

-- character
DROP TABLE IF EXISTS wcf1_character;
CREATE TABLE wcf1_character (
	characterID		INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	gameID			INT(10) NOT NULL,
	userID	 		INT(10) NOT NULL, --owner
	name		 	VARCHAR(255) NOT NULL,
	isPrimary		TINYINT(1) DEFAULT 0
);

DROP TABLE IF EXISTS wcf1_character_option;
CREATE TABLE wcf1_character_option  (
	optionID INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	optionName VARCHAR(255) NOT NULL DEFAULT '',
	categoryName VARCHAR(255) NOT NULL DEFAULT '',
	optionType VARCHAR(255) NOT NULL DEFAULT '',
	defaultValue MEDIUMTEXT,
	validationPattern TEXT,
	enableOptions MEDIUMTEXT,
	showOrder INT(10) NOT NULL DEFAULT 0,
	permissions TEXT,
	options TEXT,
	additionalData MEDIUMTEXT,
	UNIQUE KEY optionName (optionName)
);

DROP TABLE IF EXISTS wcf1_character_option_category;
CREATE TABLE wcf1_character_option_category (
	categoryID INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	categoryName VARCHAR(255) NOT NULL DEFAULT '',
	parentCategoryName VARCHAR(255) NOT NULL DEFAULT '',
	showOrder INT(10) NOT NULL DEFAULT 0,
	permissions TEXT,
	options TEXT,
	UNIQUE KEY categoryName (categoryName)
);

DROP TABLE IF EXISTS wcf1_character_option_value;
CREATE TABLE wcf1_character_option_value  (
	characterID INT(10) NOT NULL,
	optionID INT(10) NOT NULL,
	optionValue MEDIUMTEXT NOT NULL,
	UNIQUE KEY characterID (characterID, optionID)
);

-- character activity
DROP TABLE IF EXISTS wcf1_character_activity;
CREATE TABLE wcf1_character_activity (
	activityID		INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	characterID 	INT(10) NOT NULL,	
	time			INT(10) NOT NULL,
	activityName	VARCHAR(255) NOT NULL,
	additionalData	MEDIUMTEXT
);

-- character groups (e.g. raid group, battle groups, ..)
DROP TABLE IF EXISTS wcf1_character_group;
CREATE TABLE wcf1_character_group (
	groupID				INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	guildID				INT(10) DEFAULT NULL,
	name				VARCHAR(255) NOT NULL
);

DROP TABLE IF EXISTS wcf1_character_group_to_character;
CREATE TABLE wcf1_character_group_to_character(
	groupID				INT(10) NOT NULL,
	characterID			INT(10) NOT NULL,
	UNIQUE KEY(groupID, characterID)
);

-- recruitment
DROP TABLE IF EXISTS wcf1_guild_recruitment_tender;
CREATE TABLE wcf1_guild_recruitment_tender(
    tenderID    INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	gameID		INT NOT NULL,
	guildID		INT NOT NULL,
    classID     INT NOT NULL,
    roleID      INT DEFAULT 0,
	talentID    INT DEFAULT 0,
    quantity    INT,
    sortOrder   INT DEFAULT 0,
    priority    ENUM('low', 'medium', 'high'),
    UNIQUE KEY(guildID, classID, roleID, talentID)
);

DROP TABLE IF EXISTS wcf1_guild_recruitment_application;
CREATE TABLE wcf1_guild_recruitment_application(
    applicationID   INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	tenderID		INT,
    userID          INT NOT NULL,
    characterID     INT NOT NULL,
	guildID			INT NOT NULL,	
    subject         VARCHAR(255),
    text            TEXT,
    time            INT,
	accepted		BOOLEAN DEFAULT 0,
	declined		BOOLEAN DEFAULT 0
);

DROP TABLE IF EXISTS wcf1_guild_recruitment_option;
CREATE TABLE wcf1_guild_recruitment_option  (
	optionID INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	optionName VARCHAR(255) NOT NULL DEFAULT '',
	categoryName VARCHAR(255) NOT NULL DEFAULT '',
	optionType VARCHAR(255) NOT NULL DEFAULT '',
	defaultValue MEDIUMTEXT,
	validationPattern TEXT,
	enableOptions MEDIUMTEXT,
	showOrder INT(10) NOT NULL DEFAULT 0,
	permissions TEXT,
	options TEXT,
	additionalData MEDIUMTEXT,
	UNIQUE KEY optionName (optionName)
);

DROP TABLE IF EXISTS wcf1_guild_recruitment_option_category;
CREATE TABLE wcf1_guild_recruitment_option_category (
	categoryID INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	categoryName VARCHAR(255) NOT NULL DEFAULT '',
	parentCategoryName VARCHAR(255) NOT NULL DEFAULT '',
	showOrder INT(10) NOT NULL DEFAULT 0,
	permissions TEXT,
	options TEXT,
	UNIQUE KEY categoryName (categoryName)
);

DROP TABLE IF EXISTS wcf1_guild_recruitment_option_value;
CREATE TABLE wcf1_guild_recruitment_option_value  (
	characterID INT(10) NOT NULL,
	optionID INT(10) NOT NULL,
	optionValue MEDIUMTEXT NOT NULL,
	UNIQUE KEY characterID (characterID, optionID)
);

-- add foreign keys
ALTER TABLE wcf1_guild ADD FOREIGN KEY (gameID) REFERENCES wcf1_game (gameID) ON DELETE CASCADE;

ALTER TABLE wcf1_character ADD FOREIGN KEY (userID) REFERENCES wcf1_user (userID) ON DELETE CASCADE;
ALTER TABLE wcf1_character ADD FOREIGN KEY (guildID) REFERENCES wcf1_guild (guildID) ON DELETE CASCADE;
ALTER TABLE wcf1_character ADD FOREIGN KEY (gameID) REFERENCES wcf1_game (gameID) ON DELETE CASCADE;

-- \todo adds fk's for recruitment