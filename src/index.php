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
    <link rel="stylesheet" href="resources/site_layout.css" />
</head>

<body>
    <div class="top-header">
        <h3>
            Simple vulnerable webapp
        </h3>

        <div>
            This is a simple web app which contains SQL injections and code execution,
            it is based on PHP with Mysql.<br>
        </div>
    </div>

    <div class="section-wrapper">
        <div class="section">
            <div class="section-content">
                <h3>Command injection</h3>
                Want to check for ping?<p><a href="run_ping.php">Run ping</a>
            </div>
        </div>

        <div class="section">
            <div class="section-content">
                <h3>Content Injection</h3>
                Enter the comments page that has content injection vulnerability.
                <p><a href="comments.php">Go to Comments page</a>
            </div>
        </div>

        <div class="section">
            <div class="section-content">
                <h3>PHP Input wrapper injection</h3>
                This will generate a new user parsed from a JSON structure using php://input
                <p><a href="php_input_wrapper.php">Create new user</a>
            </div>
        </div>

        <div class="section">
            <div class="section-content">
                <h3>Authentication bypass (using MySQL)</h3>
                Login with any users you find in this database and password: "password" <p><a href="login.php">Go to Login page</a>
            </div>
        </div>

        <div class="section">
            <div class="section-content">
                <h3>XML External Entity</h3>
                A simple vulnerable XML external entity <p><a href="xml_external_entity.php">Go to the XML page</a>
            </div>
        </div>

        <div class="section">
            <div class="section-content">
                <h3>X Path Injection</h3>
                A simple vulnerable to XPath injection<p><a href="xpath_injection.php">Go to the Products search page</a>
            </div>
        </div>

        <div class="section">
            <div class="section-content">
                <form method="GET" style="margin-top: 15px;">
                    <h3>Search for users (SQL Injection)</h3>

                    Username:
                    <input type="text" name="name" />
                    <input type="submit" value="Search" />

                    <div style="margin-top: 12px;">
                        Remarks: Users are stored under the 'users' table.
                    </div>
                </form>

                <?php
                if (isset($_GET['name'])) print_search_users_results($_GET['name'], false);
                ?>
            </div>
        </div>

        <div class="section">
            <div class="section-content">
                <form method="GET" style="margin-top: 15px;">
                    <h3>Search for users (Blind SQL Injection)</h3>

                    Username:
                    <input type="text" name="blind_name" />
                    <input type="submit" value="Search" />

                    <div style="margin-top: 12px;">
                        Remarks: Users are stored under the 'users' table.
                    </div>
                </form>

                <?php
                if (isset($_GET['blind_name'])) print_search_users_results($_GET['blind_name'], true);
                ?>
            </div>

        </div>

        <div class="section">
            <div class="section-content">
                <form method="GET" style="margin-top: 15px;">
                    <h3>Code Injection (using eval)</h3>

                    Enter a simple calculation (for example: 5+6):
                    <p>
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
            </div>
        </div>
        <div class="section">
            <div class="section-content">
                <form method="GET" style="margin-top: 15px;">
                    <h3>Host header injection</h3>

                    Enter a location (url) you want to be redirected into:
                    <p>
                        <input type="text" name="redirect_query" />
                        <input type="submit" value="Submit" />
                </form>
            </div>
        </div>
        <div class="section">
            <div class="section-content">
                <h3>Clear the entire database:</h3>
                <form method="POST"><input name="reset_database" type="submit" value="Reset the database" /></form>
            </div>
        </div>
    </div>

</body>

</html>


<?php
require('close_db.php');
?>