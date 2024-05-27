

USE theLodurTest;

--
-- Delete the previous
--
DELETE FROM TheCities;
DELETE FROM TheUsers;

--
-- Add data
--
INSERT INTO TheCities
(name, country)
VALUES
  	('Stein am Rhein', 'Switzerland'),
    ('Zürich', 'Switzerland'),
    ('Stockholm', 'Sweden'),
    ('Simrishamn', 'Sweden')
	;
    

INSERT INTO TheUsers
(name, firstname, email, street, zipcode, city)
VALUES
    ('user1', 'user1-name', 'user1-email', 'user1-street', 'user1-zipcode', 'Stockholm'),
    ('user2', 'user2-name', 'user2-email', 'user2-street', 'user2-zipcode', 'Zürich')
	;
