<?php
/**
 * Created by IntelliJ IDEA.
 * User: maroanuyah
 * Date: 12/29/18
 * Time: 4:55 PM
 */

$db_host = "localhost:8888";
$db_username = "root";
$db_password = " ";
$db_database="querylogs";
$conn = mysql_connect($db_host, $db_username, $db_password);


// Create connection
try {
    $conn = new PDO("mysql:host=$servername; dbname=querylogs", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
}
catch(PDOException $e)
{
    echo "Connection failed: " . $e->getMessage();
}
?>