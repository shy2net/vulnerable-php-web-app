<?php
require_once('db.php');

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Use the run_query method in utils.php to create a new user
    require_once('utils.php');

    // Get the input from the textarea
    $input = file_get_contents('php://input');

    // Decode the input as JSON and extract the username and password
    $data = json_decode($input, true);
    $username = $data['username'];
    $password = $data['password'];

    $query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

    // Run the query to insert the new user
    $result = run_query($query, true);

    require_once('close_db.php');

    if ($result) {
        die("User created successfully!");
    }
}

?>

<style>
    #form {
        width: 50%;
        /* set the width of the form to 50% of the page */
        margin: auto;
        /* center the form on the page */
        padding: 16px;
        /* add some padding to the form */
    }

    textarea {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        /* add a box-shadow to the text area */
        font-family: monospace;
        /* use a monospace font for the text area */
        transition: 0.3s;
        /* add a transition to make the hover effect smooth */
        width: 100%;
        /* make the text area as wide as the form */
        height: 200px;
        /* make the text area taller */
        font-family: sans-serif;
        /* use a sans-serif font for the text area */

        margin-bottom: 10px;
    }

    textarea:hover {
        box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
        /* make the box-shadow larger on hover */
    }

    button {
        background-color: #4CAF50;
        /* set the background color of the button to green */
        color: white;
        /* set the text color of the button to white */
        padding: 16px 20px;
        /* add some padding to the button */
        border: none;
        /* remove the border from the button */
        cursor: pointer;
        /* make the cursor a pointer when hovering over the button */
        width: 100%;
        /* make the button as wide as the form */
    }

    button:hover {
        opacity: 0.8;
        /* make the button slightly transparent when hovering over it */
    }
</style>

<form id="form" method="POST">
    <h3>Enter a json for the username and password in order to create a new user:</h3>

    <textarea>{ "username": "Jack", "password": "mypassword"}</textarea>
    <button type="submit">Create user</button>
</form>

<script>
    // Get a reference to the form element
    const form = document.getElementById('form');

    // Listen for the submit event on the form
    form.addEventListener('submit', function(event) {
        // Prevent the form from being submitted
        event.preventDefault();

        // Get the value of the textarea
        const input = form.elements[0].value;

        // Decode the input as JSON
        const data = JSON.parse(input);

        // Encode the data as JSON
        const json = JSON.stringify(data);

        // Create a new request object
        const request = new XMLHttpRequest();

        // Set the HTTP method, URL, and request body
        request.open('POST', 'php_input_wrapper.php', true);
        request.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
        request.send(json);

        // Listen for the load event on the request
        request.addEventListener('load', function() {
            // Get the server's response
            const response = request.responseText;

            // Show the response in an alert
            alert(response);
        });
    });
</script>