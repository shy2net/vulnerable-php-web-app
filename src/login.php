<?php

// Import the database connection file and the run_query function
require_once 'db.php';
require_once 'utils.php';

// Check if the form has been submitted
if (isset($_POST['username']) && isset($_POST['password'])) {
    // Get the username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Create a query to check if the user exists
    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";

    // Run the query
    $result = run_query($query, true);

    // Check if the user exists
    if (mysqli_num_rows($result) > 0) {
        die("Successful login");
    } else {
        // Login failed, display an error message
        $error = "Invalid username or password";
    }
}

// Close the database connection
require_once 'close_db.php';

?>

<html>

<head>
    <title>Login</title>
</head>

<body>
    <form method="post" action="login.php">
        <label>Username:</label><br>
        <input type="text" name="username"><br>
        <label>Password:</label><br>
        <input type="password" name="password"><br>
        <input type="submit" value="Login">
    </form>
    <?php if (isset($error)) {
        echo $error;
    } ?>
</body>

</html>