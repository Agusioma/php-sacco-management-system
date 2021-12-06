<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'www.sacco.terrence-aluda.com');
define('DB_USERNAME', 'terrence_admin');
define('DB_PASSWORD', 'TerrAld$$254!');
define('DB_NAME', 'terrence_jbcs');
 
/* Attempt to connect to MySQL database */
$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($mysqli === false){
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}
?>
