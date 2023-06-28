<?php
// Get the URL from the query parameter
$url = $_GET['url'];

// Make the request to the URL
$response = file_get_contents($url);

// Print the response
echo $response;

?>