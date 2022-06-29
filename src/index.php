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



    <div class="results" style="border-top: 1px solid black; padding-top: 15px;">
        <?php

        if (isset($_GET['name'])) {
            require('db.php');

            global $db;

            $query_param = strtolower($_GET['name']);
            $query = "SELECT * FROM users WHERE LOWER(users.name) LIKE '%{$query_param}%'";

            $results = mysqli_query($db, $query) or die(mysqli_error($db));

            while ($user = $results->fetch_object()) {
                echo "{$user->name}<br>";
            }

            require('close_db.php');
        }

        ?>
    </div>
</body>

</html>