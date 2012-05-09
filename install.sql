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

-- add foreign keys
ALTER TABLE wcf1_guild ADD FOREIGN KEY (packageID) REFERENCES wcf1_package (packageID) ON DELETE CASCADE;
ALTER TABLE wcf1_guild ADD FOREIGN KEY (userID) REFERENCES wcf1_user (userID) ON DELETE CASCADE;
ALTER TABLE wcf1_guild ADD FOREIGN KEY (gameID) REFERENCES wcf1_game (gameID) ON DELETE CASCADE;

ALTER TABLE wcf1_character ADD FOREIGN KEY (packageID) REFERENCES wcf1_package (packageID) ON DELETE CASCADE;
ALTER TABLE wcf1_character ADD FOREIGN KEY (userID) REFERENCES wcf1_user (userID) ON DELETE CASCADE;
ALTER TABLE wcf1_character ADD FOREIGN KEY (guildID) REFERENCES wcf1_guild (guildID) ON DELETE CASCADE;
ALTER TABLE wcf1_character ADD FOREIGN KEY (gameID) REFERENCES wcf1_game (gameID) ON DELETE CASCADE;