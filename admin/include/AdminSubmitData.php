<?php
include '../../include/dbConfig.php';
include "../../include/queryFunction.php";
session_start();
date_default_timezone_set("Asia/Kolkata");

$moduleMethod = $_POST['moduleMethod'];
$module = $_POST['module'];
if (!empty($_POST['moduleMethod'])) {
    // admin Login
    if ($module == "adminLogin" && $moduleMethod == "admin") {
        if (!empty($_POST['adminEmail']) && !empty($_POST['adminPassword'])) {
            $Condition['email'] = $_POST['adminEmail'];
            $Condition['password'] = md5($_POST['adminPassword']);
            $response = getData($moduleMethod, $Condition);
            $response = $response->fetch_assoc();
            if (!empty($response)) {
                $_SESSION["adminId"] = $response['id'];
                $_SESSION["adminEmail"] = $response['email'];
                echo "<script>window.location.replace('../adminDashboard.php');</script>";
            } else {
                $alert_type = "alert-danger";
                $alert_message = "Incorrect adminname or password.";
                echo "<script>window.location.replace('../index.php?alert_type=" . $alert_type . "&alert_message=" . $alert_message . "');</script>";
            }
        }
    }

    //Add Category
    if ($module == "addCategory" && $moduleMethod == "category") {
        echo "****";
        if (!empty($_POST['categorySub'])) {
            $uniqid = uniqid();
            $addcategoryData = array(
                'id' => $uniqid,
                'category_name' => $_POST['category_name'],
                'category_description' => $_POST['category_description'],
                'date_entered' => date("Y-m-d H:i:s"),
                'date_modified' => date("Y-m-d H:i:s"),
                'modified_user_id' => $_SESSION["adminId"],
                'created_by' => $_SESSION["adminId"],
                'deleted' => 0,
            );
            $addcategoryDataResponse = insertData($moduleMethod, $addcategoryData);
            if (!empty($addcategoryDataResponse)) {
                $alert_type = "alert-success";
                $alert_message = "Review is added.";
                echo "<script>window.location.replace('employeeShopList.php?alert_type=" . $alert_type . "&alert_message=" . $alert_message . "');</script>";
            } else {
                $alert_type = "alert-danger";
                $alert_message = "Review is not added.";
                echo "<script>window.location.replace('employeeShopAddReview.php?alert_type=" . $alert_type . "&alert_message=" . $alert_message . "');</script>";
            }
        }
    }
}
