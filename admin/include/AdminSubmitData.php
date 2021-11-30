<?php
include '../../include/dbConfig.php';
include "../../include/queryFunction.php";
session_start();
date_default_timezone_set("Asia/Kolkata");

$moduleMethod = $_REQUEST['moduleMethod'];
$module = $_REQUEST['module'];
if (!empty($_REQUEST['moduleMethod'])) {
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

    //Category Add
    if ($module == "addCategory" && $moduleMethod == "category") {
        if (isset($_POST['categorySub'])) {
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
                $alert_message = "Category added successfully.";
                echo "<script>window.location.replace('../category.php?alert_type=" . $alert_type . "&alert_message=" . $alert_message . "');</script>";
            } else {
                $alert_type = "alert-danger";
                $alert_message = "Category is not added.";
                echo "<script>window.location.replace('../category.php?alert_type=" . $alert_type . "&alert_message=" . $alert_message . "');</script>";
            }
        }
    }

    //Edit Category
    if ($module == "editCategory" && $moduleMethod == "category") {
        if (isset($_POST['categorySub'])) {
            $editcategoryData = array(
                'category_name' => $_POST['category_name'],
                'category_description' => $_POST['category_description'],
                'date_modified' => date("Y-m-d H:i:s"),
                'modified_user_id' => $_SESSION["adminId"],
            );
            $Condition['id '] = $_POST["category_id"];
            $editCategoryResponse = updateData($moduleMethod, $editcategoryData, $Condition);
            if (!empty($editCategoryResponse)) {
                $alert_type = "alert-success";
                $alert_message = "Category updated successfully.";
                echo "<script>window.location.replace('../categoryList.php?alert_type=" . $alert_type . "&alert_message=" . $alert_message . "');</script>";
            } else {
                $alert_type = "alert-danger";
                $alert_message = "Category is not updated.";
                echo "<script>window.location.replace('../categoryList.php?alert_type=" . $alert_type . "&alert_message=" . $alert_message . "');</script>";
            }
        }
    }

    //Delete Category
    if ($module == "deleteCategory" && $moduleMethod == "category") {
        if (isset($_GET['delete'])) {
            $Condition['id'] = $_REQUEST['delete'];
            $deleteCategoryResponse = deleteData($moduleMethod, $Condition);
            if (!empty($deleteCategoryResponse)) {
                $alert_type = "alert-success";
                $alert_message = "Category deleted successfully.";
                echo "<script>window.location.replace('../categoryList.php?alert_type=" . $alert_type . "&alert_message=" . $alert_message . "');</script>";
            } else {
                $alert_type = "alert-danger";
                $alert_message = "Category is not deleted.";
                echo "<script>window.location.replace('../categoryList.php?alert_type=" . $alert_type . "&alert_message=" . $alert_message . "');</script>";
            }
        }
    }

    //Add Course
    if ($module == "addCourse" && $moduleMethod == "course") {
        if (isset($_POST['courseub'])) {
            $target_dir = "../../thumbnail/";
            $target_file = $target_dir . basename($_FILES["thumbnail"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Check if image file is a actual image or fake image
            if (isset($_POST["courseub"])) {
                $check = getimagesize($_FILES["thumbnail"]["tmp_name"]);
                if ($check !== false) {
                    echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else {
                    echo "File is not an image.";
                    $uploadOk = 0;
                }
            }

            // Check if file already exists
            if (file_exists($target_file)) {
                echo "Sorry, file already exists.";
                $uploadOk = 0;
            }

            // Check file size
            if ($_FILES["thumbnail"]["size"] > 500000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }

            // Allow certain file formats
            if (
                $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif"
            ) {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
                // if everything is ok, try to upload file
            } else {
                $uniqid = uniqid();
                $extension = pathinfo($_FILES["thumbnail"]["name"], PATHINFO_EXTENSION);
                $path = "../../thumbnail/" . $uniqid . "." . $extension;
                if (move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $path)) {
                    echo "The file " . htmlspecialchars(basename($_FILES["thumbnail"]["name"])) . " has been uploaded.";
                    $addCourseData = array(
                        'id' => $uniqid,
                        'category_id' => $_POST['category_id'],
                        'title' => $_POST['title'],
                        'description' => $_POST['description'],
                        'tags' => implode(",", $_POST['tags']),
                        'thumbnail' => $uniqid . "." . $extension,
                        'date_entered' => date("Y-m-d H:i:s"),
                        'date_modified' => date("Y-m-d H:i:s"),
                        'modified_user_id' => $_SESSION["adminId"],
                        'created_by' => $_SESSION["adminId"],
                        'deleted' => 0,
                    );
                    $addCourseDataResponse = insertData($moduleMethod, $addCourseData);
                    if (!empty($addCourseDataResponse)) {
                        $alert_type = "alert-success";
                        $alert_message = "Cource added successfully.";
                        echo "<script>window.location.replace('../course.php?alert_type=" . $alert_type . "&alert_message=" . $alert_message . "');</script>";
                    } else {
                        $alert_type = "alert-danger";
                        $alert_message = "Cource is not added.";
                        echo "<script>window.location.replace('../course.php?alert_type=" . $alert_type . "&alert_message=" . $alert_message . "');</script>";
                    }
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
        }
    }
}
