<?php
//connectToDatabaseAndClose.php
//$servername = "localhost";
//$username = "student";
//$password = "student";
//$dbname = "Wenslijst";
//$connectionString = "mysql:host=$servername;dbname=$dbname";
//$conn = null;

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'student');
define('DB_PASSWORD', 'student');
define('DB_NAME', 'wens');

/* Attempt to connect to MySQL database */
try{
    $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    die("ERROR: Could not connect. " . $e->getMessage());
}
?>