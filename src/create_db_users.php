<?php

global $db;

mysqli_query($db, 'DROP TABLE users');
mysqli_query($db, 'CREATE TABLE users (username varchar(255), password varchar(255))');

$users_json_api = 'https://jsonplaceholder.typicode.com/users';
$users = json_decode(file_get_contents($users_json_api), true);

foreach ($users as $user) {
    mysqli_query($db, "INSERT INTO users (username, password) VALUES ('{$user["name"]}', 'password')") or die(mysqli_error($db));
}

echo "<b><i>Users database successfully created!</i><b>";

