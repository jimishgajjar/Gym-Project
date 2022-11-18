<?php
$servername = "localhost";
$username = "a1611wtr_wecreate";
$password = "[IXKm(r[6NG{";
$dbname = "a1611wtr_gymnext";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
