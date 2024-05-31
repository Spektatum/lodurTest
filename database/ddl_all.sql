--
--
-- DDL : Base table LODUR test set up
-- Yso2024
--
USE theLodurTest;

SET NAMES 'utf8';

--
-- DROP BASE TABLES
-- NOTE: deletes all info & drops the tables
--
DROP TABLE IF EXISTS TheCities;
DROP TABLE IF EXISTS TheUsers;


--
-- Create table: theCities
--
CREATE TABLE TheCities
(
    name CHAR(100) UNIQUE NOT NULL,
    country CHAR(100),
        PRIMARY KEY(name)
)ENGINE INNODB
CHARSET utf8
COLLATE utf8_swedish_ci;
;

--
-- Create table: theUser
--
CREATE TABLE TheUsers
(
    name CHAR(100) UNIQUE NOT NULL,
    firstname CHAR(100),
    email CHAR(100),
    street CHAR(100),
    zipcode CHAR(100),
    city CHAR(100) NOT NULL,
    deleted boolean DEFAULT FALSE,
    	FOREIGN KEY (city) REFERENCES TheCities(name),
    PRIMARY KEY (name)
) ENGINE INNODB
  CHARSET utf8
 COLLATE utf8_swedish_ci;
;