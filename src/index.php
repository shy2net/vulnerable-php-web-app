<html>

<body>
    <h3>
        SQL Injection and Code Execution web app
    </h3>

    <div>
        This is a simple web app which contains SQL injections and code execution,
        it is based on PHP with Mysql.
    </div>


    <hr style="margin-bottom: 20px;">
    Want to check for ping? <a href="run_ping.php">Run ping</a>

    <form method="GET" style="margin-top: 15px;">
        <h3>Search for users</h3>

        Username:
        <input type="text" name="name" />
        <input type="submit" value="Search" />

        <div style="margin-top: 12px;">
            Remarks: you have to <a href="create_db_users.php">create the users database before.</a>
        </div>
    </form>

    <hr style="margin-bottom: 20px;">

    <form method="GET" style="margin-top: 15px;">
        <h3>Search for users (Blind SQL Injection)</h3>

        Username:
        <input type="text" name="blind_name" />
        <input type="submit" value="Search" />

        <div style="margin-top: 12px;">
            Remarks: you have to <a href="create_db_users.php">create the users database before.</a>
        </div>
    </form>



    <div class="results" style="border-top: 1px solid black; padding-top: 15px;">
        <?php

        $is_blind = isset($_GET['blind_name']);

        if (isset($_GET['name']) || $is_blind) {
            require('db.php');
            require('./utils.php');

            global $db;

            $query_param = strtolower($_GET['blind_name'] ?? $_GET['name']);
            $query = "SELECT * FROM users WHERE LOWER(users.name) LIKE '%{$query_param}%'";

            $results = run_query($query, isset($_GET['name']));

            // If there is an SQL injection and it's a blind one, or there is no data, return no records found.
            if (!$results && $is_blind || mysqli_num_rows($results) == 0) die("No records found");

            while ($user = $results->fetch_object()) {
                echo "{$user->name}<br>";
            }

            require('close_db.php');
        }

        ?>
    </div>
</body>

</html>