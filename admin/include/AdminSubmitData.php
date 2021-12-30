<?php
include '../../include/dbConfig.php';
include "../../include/queryFunction.php";
session_start();
date_default_timezone_set("Asia/Kolkata");

$moduleMethod = $_REQUEST['moduleMethod'];
$module = $_REQUEST['module'];

$categoryPath = "../../assets/category/";
$thumbnailPath = "../../assets/thumbnail/";

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
    if ($module == "categoryAdd" && $moduleMethod == "category") {
        if (isset($_POST['categorySub'])) {
            $target_dir = $categoryPath;
            $target_file = $target_dir . basename($_FILES["category_img"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Check if image file is a actual image or fake image
            $check = getimagesize($_FILES["category_img"]["tmp_name"]);
            if ($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }

            // Check if file already exists
            if (file_exists($target_file)) {
                echo "Sorry, file already exists.";
                $uploadOk = 0;
            }

            // Check file size
            if ($_FILES["category_img"]["size"] > 500000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }

            // Allow certain file formats
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
                // if everything is ok, try to upload file
            } else {
                $uniqid = uniqid();
                $extension = pathinfo($_FILES["category_img"]["name"], PATHINFO_EXTENSION);
                $path = $target_dir . $uniqid . "." . $extension;
                if (move_uploaded_file($_FILES["category_img"]["tmp_name"], $path)) {
                    echo "The file " . htmlspecialchars(basename($_FILES["category_img"]["name"])) . " has been uploaded.";
                    $categoryAddData = array(
                        'id' => $uniqid,
                        'category_name' => $_POST['category_name'],
                        'category_description' => $_POST['category_description'],
                        'category_img' => $uniqid . "." . $extension,
                        'date_entered' => date("Y-m-d H:i:s"),
                        'date_modified' => date("Y-m-d H:i:s"),
                        'modified_user_id' => $_SESSION["adminId"],
                        'created_by' => $_SESSION["adminId"],
                        'deleted' => 0,
                    );
                    $categoryAddDataResponse = insertData($moduleMethod, $categoryAddData);
                    if (!empty($categoryAddDataResponse)) {
                        $alert_type = "alert-success";
                        $alert_message = "Category added successfully.";
                        echo "<script>window.location.replace('../category.php?alert_type=" . $alert_type . "&alert_message=" . $alert_message . "');</script>";
                    } else {
                        $alert_type = "alert-danger";
                        $alert_message = "Category is not added.";
                        echo "<script>window.location.replace('../category.php?alert_type=" . $alert_type . "&alert_message=" . $alert_message . "');</script>";
                    }
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
        }
    }

    // Category Edit
    if ($module == "categoryEdit" && $moduleMethod == "category") {
        if (isset($_POST['categorySub'])) {
            if (!empty($_FILES["category_img"]["tmp_name"])) {
                $Condition['id'] = $_POST["edit"];
                $response = getData('category', $Condition);
                $response = $response->fetch_assoc();
                if (unlink($categoryPath . $response['category_img'])) {
                    $target_dir = $categoryPath;
                    $target_file = $target_dir . basename($_FILES["category_img"]["name"]);
                    $uploadOk = 1;
                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                    // Check if image file is a actual image or fake image
                    $check = getimagesize($_FILES["category_img"]["tmp_name"]);
                    if ($check !== false) {
                        echo "File is an image - " . $check["mime"] . ".";
                        $uploadOk = 1;
                    } else {
                        echo "File is not an image.";
                        $uploadOk = 0;
                    }

                    // Check if file already exists
                    if (file_exists($target_file)) {
                        echo "Sorry, file already exists.";
                        $uploadOk = 0;
                    }

                    // Check file size
                    if ($_FILES["category_img"]["size"] > 500000) {
                        echo "Sorry, your file is too large.";
                        $uploadOk = 0;
                    }

                    // Allow certain file formats
                    if (
                        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    ) {
                        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                        $uploadOk = 0;
                    }

                    // Check if $uploadOk is set to 0 by an error
                    if ($uploadOk == 0) {
                        echo "Sorry, your file was not uploaded.";
                        // if everything is ok, try to upload file
                    } else {
                        $extension = pathinfo($_FILES["category_img"]["name"], PATHINFO_EXTENSION);
                        $path = $categoryPath . $response['id'] . "." . $extension;
                        if (move_uploaded_file($_FILES["category_img"]["tmp_name"], $path)) {
                            echo "The file " . htmlspecialchars(basename($_FILES["category_img"]["name"])) . " has been uploaded.";
                            $categoryEditData = array(
                                'category_name' => $_POST['category_name'],
                                'category_description' => $_POST['category_description'],
                                'category_img' => $response['id'] . "." . $extension,
                                'date_modified' => date("Y-m-d H:i:s"),
                                'modified_user_id' => $_SESSION["adminId"],
                            );
                            $Condition['id'] = $_POST["edit"];
                            $categoryEditResponse = updateData($moduleMethod, $categoryEditData, $Condition);
                        } else {
                            echo "Sorry, there was an error uploading your file.";
                        }
                    }
                }
            } else {
                $courseEditData = array(
                    'id' => $_POST['edit'],
                    'category_name' => $_POST['category_name'],
                    'category_description' => $_POST['category_description'],
                    'date_modified' => date("Y-m-d H:i:s"),
                    'modified_user_id' => $_SESSION["adminId"],
                );
                $Condition['id '] = $_POST["edit"];
                $categoryEditResponse = updateData($moduleMethod, $courseEditData, $Condition);
            }
            if (!empty($categoryEditResponse)) {
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

    // Category Delete
    if ($module == "categoryDelete" && $moduleMethod == "category") {
        if (isset($_GET['delete'])) {
            $Condition['id'] = $_REQUEST['delete'];
            $response = getData('category', $Condition);
            $response = $response->fetch_assoc();

            $categoryDeleteResponse = deleteData($moduleMethod, $Condition);

            if (!empty($categoryDeleteResponse) && unlink($categoryPath . $response['thumbnail'])) {
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

    // Course Add 
    if ($module == "courseAdd" && $moduleMethod == "course") {
        if (isset($_POST['courseub'])) {
            $target_dir = $thumbnailPath;
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
                    $path = $target_dir . $uniqid . "." . $extension;
                    if (move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $path)) {
                        echo "The file " . htmlspecialchars(basename($_FILES["thumbnail"]["name"])) . " has been uploaded.";
                        $courseAddData = array(
                            'id' => $uniqid,
                            'category_id' => $_POST['category_id'],
                            'title' => $_POST['title'],
                            'small_description' => $_POST['small_description'],
                            'description' => $_POST['description'],
                            'tags' => implode(",", $_POST['tags']),
                            'thumbnail' => $uniqid . "." . $extension,
                            'rating' => 0.0,
                            'price' => $_POST['price'],
                            'discount' => $_POST['discount'],
                            'date_entered' => date("Y-m-d H:i:s"),
                            'date_modified' => date("Y-m-d H:i:s"),
                            'modified_user_id' => $_SESSION["adminId"],
                            'created_by' => $_SESSION["adminId"],
                            'deleted' => 0,
                        );
                        $courseAddDataResponse = insertData($moduleMethod, $courseAddData);
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                    if (!empty($courseAddDataResponse)) {
                        $alert_type = "alert-success";
                        $alert_message = "Cource added successfully.";
                        echo "<script>window.location.replace('../course.php?alert_type=" . $alert_type . "&alert_message=" . $alert_message . "');</script>";
                    } else {
                        $alert_type = "alert-danger";
                        $alert_message = "Cource is not added.";
                        echo "<script>window.location.replace('../course.php?alert_type=" . $alert_type . "&alert_message=" . $alert_message . "');</script>";
                    }
                }
            }
        }
    }

    // Course Edit 
    if ($module == "courseEdit" && $moduleMethod == "course") {
        if (isset($_POST['courseub'])) {
            if (!empty($_FILES["thumbnail"]["tmp_name"])) {
                $Condition['id'] = $_POST["course_id"];
                $response = getData('course', $Condition);
                $response = $response->fetch_assoc();

                if (unlink($thumbnailPath . $response['thumbnail'])) {
                    $target_dir = $thumbnailPath;
                    $target_file = $target_dir . basename($_FILES["thumbnail"]["name"]);
                    $uploadOk = 1;
                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                    // Check if image file is a actual image or fake image
                    $check = getimagesize($_FILES["thumbnail"]["tmp_name"]);
                    if ($check !== false) {
                        echo "File is an image - " . $check["mime"] . ".";
                        $uploadOk = 1;
                    } else {
                        echo "File is not an image.";
                        $uploadOk = 0;
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
                    ) {
                        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                        $uploadOk = 0;
                    }

                    // Check if $uploadOk is set to 0 by an error
                    if ($uploadOk == 0) {
                        echo "Sorry, your file was not uploaded.";
                        // if everything is ok, try to upload file
                    } else {
                        $extension = pathinfo($_FILES["thumbnail"]["name"], PATHINFO_EXTENSION);
                        $path = $thumbnailPath . $response['id'] . "." . $extension;
                        if (move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $path)) {
                            echo "The file " . htmlspecialchars(basename($_FILES["thumbnail"]["name"])) . " has been uploaded.";
                            $courseEditData = array(
                                'category_id' => $_POST['category_id'],
                                'title' => $_POST['title'],
                                'small_description' => $_POST['small_description'],
                                'description' => $_POST['description'],
                                'tags' => implode(",", $_POST['tags']),
                                'thumbnail' => $response['id'] . "." . $extension,
                                'price' => $_POST['price'],
                                'discount' => $_POST['discount'],
                                'date_modified' => date("Y-m-d H:i:s"),
                                'modified_user_id' => $_SESSION["adminId"],
                                'deleted' => 0,
                            );
                            $Condition['id '] = $_POST["course_id"];
                            $courseEditDataResponse = updateData($moduleMethod, $courseEditData, $Condition);
                        } else {
                            echo "Sorry, there was an error uploading your file.";
                        }
                    }
                }
            } else {
                $courseEditData = array(
                    'category_id' => $_POST['category_id'],
                    'title' => $_POST['title'],
                    'small_description' => $_POST['small_description'],
                    'description' => $_POST['description'],
                    'tags' => implode(",", $_POST['tags']),
                    'price' => $_POST['price'],
                    'discount' => $_POST['discount'],
                    'date_modified' => date("Y-m-d H:i:s"),
                    'modified_user_id' => $_SESSION["adminId"],
                    'deleted' => 0,
                );
                $Condition['id '] = $_POST["course_id"];
                $courseEditDataResponse = updateData($moduleMethod, $courseEditData, $Condition);
            }
            if (!empty($courseEditDataResponse)) {
                $alert_type = "alert-success";
                $alert_message = "Course updated successfully.";
                echo "<script>window.location.replace('../courseList.php?alert_type=" . $alert_type . "&alert_message=" . $alert_message . "');</script>";
            } else {
                $alert_type = "alert-danger";
                $alert_message = "Course is not updated.";
                echo "<script>window.location.replace('../courseList.php?alert_type=" . $alert_type . "&alert_message=" . $alert_message . "');</script>";
            }
        }
    }

    // Course Delete 
    if ($module == "courseDelete" && $moduleMethod == "course") {
        if (isset($_GET['delete'])) {
            $Condition['id'] = $_REQUEST['delete'];
            $response = getData('course', $Condition);
            $response = $response->fetch_assoc();

            $courseDeleteResponse = deleteData($moduleMethod, $Condition);
            if (!empty($courseDeleteResponse) && unlink($thumbnailPath . $response['thumbnail'])) {
                $alert_type = "alert-success";
                $alert_message = "Course deleted successfully.";
                echo "<script>window.location.replace('../categoryList.php?alert_type=" . $alert_type . "&alert_message=" . $alert_message . "');</script>";
            } else {
                $alert_type = "alert-danger";
                $alert_message = "Course is not deleted.";
                echo "<script>window.location.replace('../categoryList.php?alert_type=" . $alert_type . "&alert_message=" . $alert_message . "');</script>";
            }
        }
    }

    // Admin Logout
    if ($module == "adminLogout" && $moduleMethod == "logout") {
        if ($_REQUEST['logout'] == 1) {
            session_unset();
            session_destroy();
            echo "<script>window.location.replace('../index.php');</script>";
        }
    }
}
