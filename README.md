
<h1> Instructions </h1>

<h2> Set up the DB </h2>
MySQL database files are found in database directory.
Add the credentials in config/config.php under 'DATABASE CONNECTION'.
Test on the List page to see 'The database is set' below the tables.

<h2> Program start in a browser</h2>
Run in a browser with a server and database set up.
Point to the index.php file to start. 
Start to look at index.php & see how the program evolves.

<h2> Database set up </h2>
Files are in: database/
Load:
1. setup.sql
   You can also create a user in another way. 
   Remember that you then need to use those credentials when connecting to the database object.
2. ddl_all.sql
3. dml_all.sql

<h3> Connect to the database </h3>
Config/config.php 

Update 
// DATABASE CONNECTION (line 28)

Update: 
    $host  : set the host
    $theDb : set the database
    $user  : set the user 
    $pass  : set the password