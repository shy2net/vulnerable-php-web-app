<?php
require('db.php');
require('./utils.php');
?>

<html>

<body>
    <h3>
        Simple vulnerable webapp
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

    <?php
    if (isset($_GET['name'])) print_search_users_results($_GET['name'], false);
    ?>

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

    <?php
    if (isset($_GET['blind_name'])) print_search_users_results($_GET['blind_name'], true);
    ?>

    <hr style="margin-bottom: 20px;">

    <form method="GET" style="margin-top: 15px;">
        <h3>Code Injection</h3>

        Enter a simple calculation (for example: 5+6):
        <input type="text" name="eval_query" />
        <input type="submit" value="Submit" />

        <?php
        if (isset($_GET['eval_query'])) {
            $eval_query = $_GET['eval_query'];
            eval("\$result = $eval_query;");
            echo "<br><b>Result: ${result}</b>";
        }
        ?>

        </div>
    </form>
</body>

</html>


<?php
require('close_db.php');
?>