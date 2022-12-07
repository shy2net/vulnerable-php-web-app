<style>
    /* Add some padding and margin to the form */
    form {
        padding: 10px;
        margin: 10px;
    }

    /* Style the label and input fields */
    label,
    input {
        display: block;
        margin: 10px 0;
    }

    /* Reduce the padding between the label and input */
    label {
        padding-top: 5px;
    }

    input {
        margin-top: 5px;
    }

    /* Reduce the margin on the top input and label */
    form>label,
    form>input {
        margin-top: 0;
    }

    /* Style the submit button */
    button[type="submit"] {
        padding: 5px 10px;
        background-color: #333;
        color: #fff;
        border: 0;
        border-radius: 5px;
    }

    /* Style the comments container */
    .comments {
        margin: 10px;
        padding: 10px;
        background-color: #eee;
        border-radius: 5px;
    }

    /* Style the individual comments */
    .comments p {
        margin: 5px;
        padding: 5px;
        background-color: #fff;
        border-radius: 5px;
    }
</style>

<?php

require_once('./db.php');
require_once('./utils.php');

// If the form was submitted, insert the comment into the "comments" table
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $comment = $_POST['comment_content'];
    $query = "INSERT INTO comments (content) VALUES ('$comment')";
    run_query($query, true);
}

// Fetch the comments from the "comments" table
$query = "SELECT content FROM comments";
$result = run_query($query);

?>

<!-- Render the form and the comments -->
<form method="POST">
    <label for="comment-content">Enter your comment here:</label>
    <input type="text" id="comment_content" name="comment_content">
    <button type="submit">Send comment</button>
</form>

<div class="comments">
    <?php while ($row = $result->fetch_assoc()) : ?>
        <p>Comment: <?php echo $row['content']; ?></p>
    <?php endwhile; ?>
</div>

<?php
require_once('./close_db.php');
?>