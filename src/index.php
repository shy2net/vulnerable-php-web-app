<?php

if (isset($_GET['redirect_query'])) {
    Header("Location: $_GET[redirect_query]");
    die("Redirect should be happening here");
}

require_once('db.php');
require_once('./utils.php');

if (isset($_POST['reset_database'])) {
    run_query("DROP TABLE users, comments");
    die("Database has been cleared");
}

?>

<html>

<head>
    <style>
        body {
            background-color: black;
            color: white;
        }

        a {
            color: #1e90ff;
        }

        h3 {
            margin-bottom: 10px;
        }

        input[type="text"],
        input[type="submit"] {
            padding: 10px;
            border: none;
            border-radius: 3px;
            margin-top: 10px;
            font-size: 14px;
            background-color: #333;
            color: white;
        }

        input[type="submit"] {
            background-color: #1e90ff;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <h3>
        Simple vulnerable webapp
    </h3>

    <div>
        This is a simple web app which contains SQL injections and code execution,
        it is based on PHP with Mysql.<br>
    </div>


    <hr style="margin-bottom: 20px;">
    <h3>Command injection</h3>
    Want to check for ping? <a href="run_ping.php">Run ping</a>

    <hr style="margin-bottom: 20px;">
    <h3>Content Injection</h3>
    Enter the comments page that has content injection vulnerability.
    <p><a href="comments.php">Go to Comments page</a>
        <hr style="margin-bottom: 20px;">
    <h3>PHP Input wrapper injection</h3>
    This will generate a new user parsed from a JSON structure using php://input
    <p><a href="php_input_wrapper.php">Create new user</a>

        <hr style="margin-bottom: 20px;">

    <h3>Authentication bypass (using MySQL)</h3>
    Login with any users you find in this database and password: "password" <p><a href="login.php">Go to Login page</a>

        <hr style="margin-bottom: 20px;">

    <form method="GET" style="margin-top: 15px;">
        <h3>Search for users (SQL Injection)</h3>

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
        <h3>Code Injection (using eval)</h3>

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


    </form>

    <hr style="margin-bottom: 20px;">

    <form method="GET" style="margin-top: 15px;">
        <h3>Host header injection</h3>

        Enter a location (url) you want to be redirected into:
        <input type="text" name="redirect_query" />
        <input type="submit" value="Submit" />
    </form>

    <hr style="margin-bottom: 15px;">
    <h3>Clear the entire database:</h3>
    <form method="POST"><input name="reset_database" type="submit" value="Reset the database" /></form>
</body>

</html>


<?php
require('close_db.php');
?>