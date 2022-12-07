<!DOCTYPE html>
<html>

<head>
    <title>XML Parser</title>
    <style>
        body {
            background-color: #f2f2f2;
            /* set the background color to a light gray */
            color: #333;
            /* set the text color to a dark gray */
            text-align: center;
            /* center the text on the page */
            font-family: sans-serif;
            /* use a sans-serif font for the text */
        }

        h1 {
            margin-top: 16px;
            /* add some space between the top of the page and the heading */
            margin-bottom: 8px;
            /* add some space between the heading and the form */
        }

        textarea {
            width: 50%;
            /* set the width of the text area to 50% of the page */
            height: 200px;
            /* set the height of the text area to 200px */
            margin: auto;
            /* center the text area on the page */
            padding: 8px;
            /* add some padding to the text area */
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            /* add a box-shadow to the text area */
            font-family: monospace;
            /* use a monospace font for the text in the text area */
        }

        button {
            background-color: #333;
            /* set the background color of the button to a dark gray */
            color: #f2f2f2;
            /* set the text color of the button to a light gray */
            padding: 8px 16px;
            /* add some padding to the button */
            margin-top: 8px;
            /* add some space between the button and the text area */
            border: none;
            /* remove the border from the button */
            cursor: pointer;
            /* make the cursor a pointer when hovering over the button */
            font-family: sans-serif;
            /* use a sans-serif font for the text in the button */
        }

        button:hover {
            opacity: 0.8;
            /* make the button slightly transparent when hovering over it */
        }
    </style>
</head>

<body>
    <h1>XML Parser</h1>

    <form method="POST">
        <textarea name="xml_data">
            <book>
                <title>The Cat in the Hat</title>
                <author>Dr. Seuss</author>
            </book>

        </textarea><br>
        <button type="submit">Parse XML</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $xml = simplexml_load_string($_POST['xml_data']);
        $dom = dom_import_simplexml($xml)->ownerDocument;
        $dom->formatOutput = true;

    ?>
        <h3>This is the parsed XML:</h3>
        <textarea>
        <?php echo $dom->saveXML(); ?>
        </textarea>

    <?php
    }
    ?>
</body>

</html>