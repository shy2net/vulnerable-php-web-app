<?php
global $db;

$db = mysqli_connect('db', 'root', 'root', "mysql");

// Check if the users database exists
$query = "SELECT 1 FROM users LIMIT 1";
$result = mysqli_query($db, $query);

if (!$result) {
    require_once('./create_db.php');
}
