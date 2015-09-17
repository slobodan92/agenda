<?php

$id = $_GET['ContactId'];

$mysqli = new mysqli( 'localhost', 'root', '', 'shqdb');

$mysqli->multi_query("DELETE FROM contact WHERE ContactId='$id'; DELETE FROM contactdetails WHERE ContactId='$id'; DELETE FROM address WHERE ContactId='$id'; ");

header('Location: search.php');

?>