<html>

<head>
    <style>
        /* Center the body */
        body {
            text-align: center;
        }

        /* Style the form */
        form {
            /* Center the form */
            margin: 0 auto;
            /* Add some padding */
            padding: 1em;
        }

        /* Style the form inputs */
        input[type="text"],
        input[type="submit"] {
            /* Add some padding */
            padding: 0.5em;
            /* Add a border */
            border: 1px solid #ccc;
        }

        /* Style the search results */
        ul {
            /* Remove the default list style */
            list-style: none;
            /* Center the list */
            margin: 0 auto;
            /* Add some padding */
            padding: 1em;
        }

        /* Style the list items */
        li {
            /* Add a border */
            border-bottom: 1px solid #ccc;
            /* Add some padding */
            padding: 0.5em;
        }
    </style>
</head>

<body>
    <h1>Product Search</h1>

    <form action="" method="get">
        Search query: <input type="text" name="search_query" />
        <br />
        <input type="submit" value="Search" />
    </form>

    <?php
    // Check if the form was submitted
    if (isset($_GET['search_query'])) {

        // Load the XML document
        $xml = simplexml_load_file("resources/products.xml");

        // Get the user-supplied search query from the form
        $search_query = $_GET['search_query'];

        // Check if nothing was entered, if so say nothing was found
        if (!$search_query) die("Nothing found");

        // Build the XPath expression
        $xpath = "//product[contains(name, '" . $search_query . "')]";

        // Execute the XPath query on the XML document
        $results = $xml->xpath($xpath);

        // Create an HTML list to display the results
        echo "<ul>";
        foreach ($results as $result) {
            echo "<li>" . $result->name . ": " . $result->price . "</li>";
        }
        echo "</ul>";
    }
    ?>
</body>

</html>