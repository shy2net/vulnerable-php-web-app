<?php
require('./db.php');
global $db;

$results = mysqli_query($db, 'SELECT * FROM users') or die(mysqli_error($db));

while ($user = $results->fetch_object()) {
    echo "{$user->name}<br>";
}

require('./close_db.php');
