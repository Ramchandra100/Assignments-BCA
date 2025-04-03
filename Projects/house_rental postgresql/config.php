<?php
$connection_string = "host=localhost port=5433 dbname=postgres user=postgres password=root";
$conn = pg_connect($connection_string);

if (!$conn) {
    die("Connection failed: " . pg_last_error());
}
?>