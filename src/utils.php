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


function print_search_users_results($query, $is_blind) {
    if ($query) {
    ?>

        <div class="results" style="border-top: 1px solid black; padding-top: 15px;"><?php

    global $db;

    $query_param = strtolower($query);
    $query = "SELECT * FROM users WHERE LOWER(users.name) LIKE '%{$query_param}%'";

    $results = run_query($query, isset($_GET['name']));

    // If there is an SQL injection and it's a blind one, or there is no data, return no records found.
    if (!$results && $is_blind || mysqli_num_rows($results) == 0)
        echo "No records found";
    else {
        while ($user = $results->fetch_object()) {
            echo "{$user->name}<br>";
        }
    }

    ?> </div><?php
}


}