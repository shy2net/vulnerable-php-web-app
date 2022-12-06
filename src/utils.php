<?php

function run_query($query, $show_error = false)
{
    global $db;
    $result = mysqli_query($db, $query);

    if ($show_error && !$result) {
        die(mysqli_error($db));
    }

    return $result;
}
