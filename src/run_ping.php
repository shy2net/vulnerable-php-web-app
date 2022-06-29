Check ping for the following target:
<form type="GET">
    <input type="text" name="target" />
    <input type="submit" value="Run ping" />
</form>


<?php
if (isset($_GET['target'])) {
    $target = $_GET['target'];

    echo "Running ping to ${target}...";

    $output = shell_exec("ping -c3 ${target}");

    if (!$output) {
        echo "Failed to ping ${target}";
    } else {
        echo str_replace("\n", "<br>", $output);
    }
}
?>