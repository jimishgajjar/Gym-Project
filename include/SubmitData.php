<?php
include 'dbConfig.php';
include "queryFunction.php";
session_start();
date_default_timezone_set("Asia/Kolkata");

$moduleMethod = $_POST['moduleMethod'];
$module = $_POST['module'];
if (!empty($_POST['moduleMethod'])) {
    // User Login
    if ($module == "userLogin" && $moduleMethod == "user") {
        if (!empty($_POST['userEmail']) && !empty($_POST['userPassword'])) {
            $Condition['email'] = $_POST['userEmail'];
            $Condition['password'] = md5($_POST['userPassword']);
            $response = getData($moduleMethod, $Condition);
            $response = $response->fetch_assoc();
            if (!empty($response)) {
                $_SESSION["userId"] = $response['id'];
                $_SESSION["userEmail"] = $response['email'];
                echo "<script>window.location.replace('../userDashboard.php');</script>";
            } else {
                $alert_type = "alert-danger";
                $alert_message = "Incorrect username or password.";
                echo "<script>window.location.replace('../userLogin.php?alert_type=" . $alert_type . "&alert_message=" . $alert_message . "');</script>";
            }
        }
    }

    // User Sign Up
    if ($module == "userSignup" && $moduleMethod == "user") {
        $uniqid = uniqid();
        $userData = array(
            'id' => uniqid(),
            'full_name ' => $_POST['full_name'],
            'email ' => $_POST['userEmail'],
            'password' => md5($_POST['userPassword']),
        );
        if (!empty($userData)) {
            $response = insertData($moduleMethod, $userData);
            if (!empty($response)) {
                $alert_type = "alert-success";
                $alert_message = "Your account is created.";
                echo "<script>window.location.replace('../userLogin.php?alert_type=" . $alert_type . "&alert_message=" . $alert_message . "');</script>";
            }
        } else {
            $alert_type = "alert-danger";
            $alert_message = "Something want wrong <span>please try again!</span>";
            echo "<script>window.location.replace('../userSignUp.php?alert_type=" . $alert_type . "&alert_message=" . $alert_message . "');</script>";
        }
    }
}
