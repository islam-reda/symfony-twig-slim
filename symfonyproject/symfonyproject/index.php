<?php
$servername = "localhost";
$username = "root";
$password = "E83mq6BVnjBo97";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected succesblablasfully";
?>
