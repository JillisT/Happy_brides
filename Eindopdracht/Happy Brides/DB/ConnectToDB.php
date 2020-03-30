<?php
$host = "localhost";
$databaseName = "Happybrides";
$connectionString = "mysql:host=$host;dbname=$databaseName";
$username = "student";     //root is default in most cases
$password = "student";     //root is default in most cases

$conn = null;

try {
    $conn = new PDO($connectionString, $username, $password);

    //enables exception mode, exception is throw when an error occurs
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $ex) {
    echo "PDOException:  $ex";
}
?>