<?php
/*Database credentials and initializing*/

define('DB_SERVER', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'drawItDb');
$servername = "localhost";
$username = "root";
$password = "";
$databasename = "drawit";

/*Attempt mySQL databse connection*/
$conn = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

//Check connction
if (mysqli_connect_error()) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "";