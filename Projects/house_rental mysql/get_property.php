<?php
include('config.php');

$property_id = $_GET['id'];

$query = "SELECT * FROM properties WHERE id = $property_id";
$result = mysqli_query($conn, $query);
$property = mysqli_fetch_assoc($result);

echo json_encode($property);
?>
