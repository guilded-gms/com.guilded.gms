-- guild
DROP TABLE IF EXISTS wcf1_guild;
CREATE TABLE wcf1_guild (
	guildID			INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	packageID 		INT(10) NOT NULL,
	gameID			INT(10) NOT NULL,
	userID	 		INT(10) NOT NULL, --owner
	guildName 		VARCHAR(255) NOT NULL,
	server 			VARCHAR(255),
	image 			VARCHAR(255)
);

DROP TABLE IF EXISTS wcf1_guild_option;
CREATE TABLE wcf1_guild_option  (
	optionID INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	packageID INT(10),
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
	UNIQUE KEY optionName (optionName, packageID)
);

DROP TABLE IF EXISTS wcf1_guild_option_category;
CREATE TABLE wcf1_guild_option_category (
	categoryID INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	packageID INT(10) NOT NULL,
	categoryName VARCHAR(255) NOT NULL DEFAULT '',
	parentCategoryName VARCHAR(255) NOT NULL DEFAULT '',
	showOrder INT(10) NOT NULL DEFAULT 0,
	permissions TEXT,
	options TEXT,
	UNIQUE KEY categoryName (categoryName, packageID)
);

DROP TABLE IF EXISTS wcf1_guild_option_value;
CREATE TABLE wcf1_guild_option_value  (
	guildID INT(10) NOT NULL,
	optionID INT(10) NOT NULL,
	optionValue MEDIUMTEXT NOT NULL,
	UNIQUE KEY guildID (guildID, optionID)
);

-- character
DROP TABLE IF EXISTS wcf1_character;
CREATE TABLE wcf1_character (
	characterID		INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	packageID 		INT(10) NOT NULL,
	gameID			INT(10) NOT NULL,
	userID	 		INT(10) NOT NULL, --owner
	guildID			INT(10) DEFAULT NULL,
	characterName 	VARCHAR(255) NOT NULL,
	isPrimary		TINYINT(1) DEFAULT 0
);

DROP TABLE IF EXISTS wcf1_character_option;
CREATE TABLE wcf1_character_option  (
	optionID INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	packageID INT(10),
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
	UNIQUE KEY optionName (optionName, packageID)
);

DROP TABLE IF EXISTS wcf1_character_option_category;
CREATE TABLE wcf1_character_option_category (
	categoryID INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	packageID INT(10) NOT NULL,
	categoryName VARCHAR(255) NOT NULL DEFAULT '',
	parentCategoryName VARCHAR(255) NOT NULL DEFAULT '',
	showOrder INT(10) NOT NULL DEFAULT 0,
	permissions TEXT,
	options TEXT,
	UNIQUE KEY categoryName (categoryName, packageID)
);

DROP TABLE IF EXISTS wcf1_character_option_value;
CREATE TABLE wcf1_character_option_value  (
	characterID INT(10) NOT NULL,
	optionID INT(10) NOT NULL,
	optionValue MEDIUMTEXT NOT NULL,
	UNIQUE KEY characterID (characterID, optionID)
);

-- add foreign keys
ALTER TABLE wcf1_guild ADD FOREIGN KEY (packageID) REFERENCES wcf1_package (packageID) ON DELETE CASCADE;
ALTER TABLE wcf1_guild ADD FOREIGN KEY (userID) REFERENCES wcf1_user (userID) ON DELETE CASCADE;
ALTER TABLE wcf1_guild ADD FOREIGN KEY (gameID) REFERENCES wcf1_game (gameID) ON DELETE CASCADE;

ALTER TABLE wcf1_character ADD FOREIGN KEY (packageID) REFERENCES wcf1_package (packageID) ON DELETE CASCADE;
ALTER TABLE wcf1_character ADD FOREIGN KEY (userID) REFERENCES wcf1_user (userID) ON DELETE CASCADE;
ALTER TABLE wcf1_character ADD FOREIGN KEY (guildID) REFERENCES wcf1_guild (guildID) ON DELETE CASCADE;
ALTER TABLE wcf1_character ADD FOREIGN KEY (gameID) REFERENCES wcf1_game (gameID) ON DELETE CASCADE;