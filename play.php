<?php

// Get the name and class from the POST data
$name = $_POST['name'];
$class = $_POST['class'];

if (!isset($name) || $class == "NULL" || !isset($class)) {
    header("Location: index.php?nodata");
    die();
}

// Handle starting the game


session_start();
$_SESSION['auth'] = TRUE;
// Redirect the user to "mäng.php"
header("Location: game.php");
exit;

?>
