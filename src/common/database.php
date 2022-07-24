<?php

$db_host = "localhost";
$db_name = "blog";
$db_username = "root";
$db_password = "";

try {
    $db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
}
catch (PDOException $e) {
    echo "SQL-Error: " . $e->getMessage();
    exit();
}