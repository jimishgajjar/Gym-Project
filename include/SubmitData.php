<?php
include "queryFunction.php";
session_start();
include 'dbConfig.php';
date_default_timezone_set("Asia/Kolkata");

$moduleMethod = $_POST['moduleMethod'];
$module = $_POST['module'];

if (!empty($_POST['moduleMethod'])) {
    if ($module == "user" && $moduleMethod == "user_login") {
        if (!empty($_POST['userEmail']) && !empty($_POST['userPassword'])) {
            $Condition['email'] = $_POST['userEmail'];
            $Condition['password'] = md5($_POST['userPassword']);
            $response = getData($moduleMethod, $Condition);
            $response = $response->fetch_assoc();
            if (!empty($response)) {
                $_SESSION["UserId"] = $response['id'];
                $_SESSION["Username"] = $response['email'];

                echo "<script>window.location.replace('employeeDashboard.php');</script>";
            } else {
                $alert_type = "alert-danger";
                $alert_message = "Incorrect username or password.";
                echo "<script>window.location.replace('employeeLogin.php?alert_type=" . $alert_type . "&alert_message=" . $alert_message . "');</script>";
            }
        }
    }
}
