<?php

$dbname = 'smartdb';
$dsn = "mysql:host=localhost;dbname=$dbname"; //Data source name
$username = 'root';
$password = '';

try
{
    $pdo = new PDO($dsn,$username,$password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
    $status =  $pdo->getAttribute(PDO::ATTR_CONNECTION_STATUS);

} catch (PDOException $e) {
    echo "Unable to Connect to db ";
}
//Check Connection Status
// $status ? print("Connected to DB") : print("Not Connected");


?>