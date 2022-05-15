<?php
require('./db.php');
global $db;

mysqli_query($db, 'DROP TABLE users');
mysqli_query($db, 'CREATE TABLE users (name varchar(255))');

$users_json_api = 'https://jsonplaceholder.typicode.com/users';
$users = json_decode(file_get_contents($users_json_api), true);

foreach ($users as $user) {
    mysqli_query($db, "INSERT INTO users (name) VALUES ('{$user["name"]}')") or die(mysqli_error($db));
}


require('./close_db.php');
