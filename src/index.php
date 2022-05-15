<html>

<body>
    <form method="GET">
        Username:
        <input type="text" name="name" />
        <input type="submit" value="Search" />
    </form>


    <div class="results">
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