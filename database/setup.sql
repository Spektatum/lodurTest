-- Create the database --
CREATE DATABASE IF NOT EXISTS theLodurTest;

-- Decide which database that you will use --
USE theLodurTest;


-- Create a user with password 'pass', not restricted to host
-- Drop if it already exists
DROP USER IF EXISTS 'user'@'%';

CREATE USER IF NOT EXISTS 'user'@'%'
IDENTIFIED
BY 'pass'
;

-- Grant the user all privledges
GRANT ALL PRIVILEGES
    ON *.*
    TO 'user'@'%'
;
