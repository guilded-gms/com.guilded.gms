-- @TODO resolve class/race dependency

DROP TABLE IF EXISTS wcf1_game;
CREATE TABLE wcf1_game (
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

DROP TABLE IF EXISTS wcf1_game_role;
CREATE TABLE wcf1_game_role (
  roleID 			INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  gameID 			INT(10) NOT NULL,
  title		   VARCHAR(255),
  icon	   		VARCHAR(255),
  isEnabled		TINYINT(1) DEFAULT 1,
  UNIQUE KEY(gameID, title)
) ENGINE=INNODB CHARSET=utf8;

DROP TABLE IF EXISTS wcf1_game_faction;
CREATE TABLE wcf1_game_faction (
  factionID 		INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  gameID 			INT(10) NOT NULL,
  identifier		VARCHAR(255),
  title		   VARCHAR(255),
  icon	   		VARCHAR(255),
  isEnabled		TINYINT(1) DEFAULT 1,
  UNIQUE KEY(gameID, title)
) ENGINE=INNODB CHARSET=utf8;

DROP TABLE IF EXISTS wcf1_game_race;
CREATE TABLE wcf1_game_race (
  raceID 			INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  gameID 			INT(10) NOT NULL,
  factionID 		INT(10) DEFAULT NULL,
  identifier		VARCHAR(255),
  title		   VARCHAR(255),
  icon	   		VARCHAR(255),
  isEnabled		TINYINT(1) DEFAULT 1,
  parent			INT(10),
	UNIQUE KEY(gameID, title)
) ENGINE=INNODB CHARSET=utf8;

DROP TABLE IF EXISTS wcf1_game_class;
CREATE TABLE wcf1_game_class (
  classID 		INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  gameID 			INT(10) NOT NULL,
  identifier		VARCHAR(255),
  title		   VARCHAR(255),
  icon	   		VARCHAR(255),
  isEnabled		TINYINT(1) DEFAULT 1,
  parent			INT(10),
  UNIQUE KEY(gameID, title)
) ENGINE=INNODB CHARSET=utf8;

DROP TABLE IF EXISTS wcf1_game_instance;
CREATE TABLE wcf1_game_instance (
  instanceID 		INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  gameID 			INT(10) NOT NULL,
  identifier		VARCHAR(255),
  title		   VARCHAR(255),
  icon	   		VARCHAR(255),
  difficulty		VARCHAR(255),
  isEnabled		TINYINT(1) DEFAULT 1,
	UNIQUE KEY(gameID, title)
) ENGINE=INNODB CHARSET=utf8;

DROP TABLE IF EXISTS wcf1_game_combatant;
CREATE TABLE wcf1_game_combatant (
  combatantID 	INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  gameID 			INT(10) NOT NULL,
  instanceID		INT(10) NOT NULL,
  identifier		VARCHAR(255),
  title		   VARCHAR(255),
  icon	   		VARCHAR(255),
  isEnabled		TINYINT(1) DEFAULT 1,
  UNIQUE KEY(gameID, title)
) ENGINE=INNODB CHARSET=utf8;

DROP TABLE IF EXISTS wcf1_game_talent;
CREATE TABLE wcf1_game_talent (
  talentID 		INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  gameID 			INT(10) NOT NULL,
  classID			INT(10) NOT NULL,
  identifier		VARCHAR(255),
  title		   VARCHAR(255),
  icon	   		VARCHAR(255),
  isEnabled		TINYINT(1) DEFAULT 1,
  UNIQUE KEY(gameID, title)
) ENGINE=INNODB CHARSET=utf8;

DROP TABLE IF EXISTS wcf1_game_item;
CREATE TABLE wcf1_game_item (
	itemID 			INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	gameID 			INT(10) NOT NULL,
	externalID		VARCHAR(255),
	languageID		INT(10) NOT NULL,
	additionalData	TEXT,
	UNIQUE KEY(gameID, externalID, languageID)
) ENGINE=INNODB CHARSET=utf8;

DROP TABLE IF EXISTS wcf1_game_server;
CREATE TABLE wcf1_game_server (
  serverID 			INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  gameID 			INT(10) NOT NULL,
  name				VARCHAR(255),
  status			VARCHAR(55),
  type				VARCHAR(55),
  isOnline			TINYINT(1) DEFAULT 1,
  UNIQUE KEY(gameID, name)
) ENGINE=INNODB CHARSET=utf8;

-- foreign keys
ALTER TABLE wcf1_game_role ADD FOREIGN KEY (gameID) REFERENCES wcf1_game (gameID) ON DELETE CASCADE;

ALTER TABLE wcf1_game_faction ADD FOREIGN KEY (gameID) REFERENCES wcf1_game (gameID) ON DELETE CASCADE;

ALTER TABLE wcf1_game_race ADD FOREIGN KEY (gameID) REFERENCES wcf1_game (gameID) ON DELETE CASCADE;
ALTER TABLE wcf1_game_race ADD FOREIGN KEY (factionID) REFERENCES wcf1_game_faction (factionID) ON DELETE CASCADE;

ALTER TABLE wcf1_game_class ADD FOREIGN KEY (gameID) REFERENCES wcf1_game (gameID) ON DELETE CASCADE;

ALTER TABLE wcf1_game_instance ADD FOREIGN KEY (gameID) REFERENCES wcf1_game (gameID) ON DELETE CASCADE;

ALTER TABLE wcf1_game_combatant ADD FOREIGN KEY (gameID) REFERENCES wcf1_game (gameID) ON DELETE CASCADE;
ALTER TABLE wcf1_game_combatant ADD FOREIGN KEY (instanceID) REFERENCES wcf1_game_instance (instanceID) ON DELETE CASCADE;

ALTER TABLE wcf1_game_talent ADD FOREIGN KEY (gameID) REFERENCES wcf1_game (gameID) ON DELETE CASCADE;
ALTER TABLE wcf1_game_talent ADD FOREIGN KEY (classID) REFERENCES wcf1_game_class (classID) ON DELETE CASCADE;

ALTER TABLE wcf1_game_item ADD FOREIGN KEY (gameID) REFERENCES wcf1_game (gameID) ON DELETE CASCADE;

ALTER TABLE wcf1_game_server ADD FOREIGN KEY (gameID) REFERENCES wcf1_game (gameID) ON DELETE CASCADE;