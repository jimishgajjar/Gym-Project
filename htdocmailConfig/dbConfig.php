<?php
$servername = "localhost";
$username = "a1611wtr_wecreate";
$password = "wecreate@database";
$dbname = "a1611wtr_letsbiz";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}