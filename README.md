<h1>Manual Set Up </h1>
<h2>Set up the DB </h2>
MySQL database files are found in database directory.
And pasted at the end of the document.

database/ 
1.	setup.sql
Includes a user set up. And a database creation.
A user/database can be created in other ways.
If you already have a user/database with password then use it as credentials and exclude the sql.
2.	ddl.all.sql
3.	dml_all.sql sql

Add the credentials to the database object in :

config/config.php 

under 'DATABASE CONNECTION'. (see below)

Test on the List page to see 'The database is set' below the tables. 

<h2>Connect to the database object</h2>
config/config.php 
Update here: // DATABASE CONNECTION (line 28)
<b>$host</b> : set the host 
<b>$theDb</b> : set the database 
<b>$user</b> : set the user 
<b>$pass</b> : set the password

<h2>Program start in a browser</b>
Run in a browser with a server and database set up. 
Point to the index.php file to start.  
You can follow the program flow from there.






