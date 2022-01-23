<?php
include 'dbConfig.php';
include "queryFunction.php";
session_start();
date_default_timezone_set("Asia/Kolkata");

$moduleMethod = $_REQUEST['moduleMethod'];
$module = $_REQUEST['module'];

$ip = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];

$userProfilePath = "../assets/userprofile/";


if (!empty($_REQUEST['moduleMethod'])) {
    // User Sign Up
    if ($module == "userSignup" && $moduleMethod == "user") {
        if (isset($_POST['userSignupSub'])) {
            $uniqid = uniqid();
            $userData = array(
                'id' => uniqid(),
                'full_name' => $_POST['full_name'],
                'email' => $_POST['email'],
                'mobile_no' => $_POST['mobile_no'],
                'height' => $_POST['height'],
                'weight' => $_POST['weight'],
                'age' => $_POST['age'],
                'gender' => $_POST['gender'],
                'password' => md5($_POST['password']),
                'reset_key' => "NOT SET",
                'reset_status' => 0,
                'date_entered' => date("Y-m-d H:i:s"),
                'date_modified' => date("Y-m-d H:i:s"),
                'modified_user_id' => $uniqid,
                'created_by' => $uniqid,
                'deleted' => 0,
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

    // User Login
    if ($module == "userLogin" && $moduleMethod == "user") {
        if (isset($_POST['userLoginSub'])) {
            if (!empty($_POST['email']) && !empty($_POST['password'])) {
                $Condition['email'] = $_POST['email'];
                $Condition['password']  = md5($_POST['password']);
                $response = getData($moduleMethod, $Condition);
                $response = $response->fetch_assoc();
                if (!empty($response)) {
                    $_SESSION["userId"] = $response['id'];
                    $_SESSION["userEmail"] = $response['email'];
                    echo "<script>window.location.replace('../index.php');</script>";
                } else {
                    $alert_type = "alert-danger";
                    $alert_message = "Incorrect username or password.";
                    echo "<script>window.location.replace('../userLogin.php?alert_type=" . $alert_type . "&alert_message=" . $alert_message . "');</script>";
                }
            }
        }
    }

    // User Forgot Password Link Generate
    if ($module == "userForgotPassword" && $moduleMethod == "user") {
        if (isset($_POST['userForgotPasswordSub'])) {
            if (!empty($_POST['email'])) {
                $Condition['email'] = $_POST["email"];
                $response = getData('user', $Condition);
                $response = $response->fetch_assoc();
                if (!empty($response)) {
                    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@#$%^&*()_+|=-/*';
                    $key = array(); //remember to declare $pass as an array
                    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
                    for ($i = 0; $i < 32; $i++) {
                        $n = rand(0, $alphaLength);
                        $key[] = $alphabet[$n];
                    }
                    // echo implode($pass); //turn the array into a string

                    // Program to display URL of current page.
                    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
                        $link = "https";
                    else $link = "http";

                    // Here append the common URL characters.
                    $link .= "://";

                    // Append the host(domain name, ip) to the URL.
                    $link .= $_SERVER['HTTP_HOST'];

                    // Append the requested resource location to the URL
                    $link .= $_SERVER['REQUEST_URI'];

                    $key = md5(implode($key));
                    $md5Email = md5($response['email']);
                    $urlPass = $link . "?moduleMethod=user&module=userResetPassLink&email=" . $md5Email . "&reset_key=" . $key;
                    $to = $response['email'];
                    $subject = "Changed Password";
                    $txt = "Your rest password link is\n\n " . $urlPass;
                    if (mail($to, $subject, $txt)) {
                        $passwordRestData = array(
                            'reset_key' => $key,
                            'reset_status' => 1,
                        );
                        $Condition['email'] = $response['email'];
                        $passwordRestResponse = updateData($moduleMethod, $passwordRestData, $Condition);
                        if (!empty($passwordRestResponse)) {
                            $alert_type = "alert-success";
                            $alert_message = "You should soon receive an email allowing you to reset your password. Please make sure to check your spam and trash if you can not find the email.";
                            echo "<script>window.location.replace('../userLogin.php?alert_type=" . $alert_type . "&alert_message=" . $alert_message . "');</script>";
                        }
                    } else {
                        $alert_type = "alert-danger";
                        $alert_message = "Something went wrong please try again.";
                        echo "<script>window.location.replace('../userForgotPassword.php?alert_type=" . $alert_type . "&alert_message=" . $alert_message . "');</script>";
                    }
                } else {
                    $alert_type = "alert-danger";
                    $alert_message = "Email id does not exist";
                    echo "<script>window.location.replace('../userForgotPassword.php?alert_type=" . $alert_type . "&alert_message=" . $alert_message . "');</script>";
                }
            }
        }
    }

    // User Rest Password Page
    if ($module == "userResetPassLink" && $moduleMethod == "user") {
        if (!empty($_REQUEST['email']) && !empty($_REQUEST['reset_key'])) {
            $Condition['reset_key']  = $_REQUEST['reset_key'];
            $Condition['reset_status']  = 1;
            $response = getData($moduleMethod, $Condition);
            $response = $response->fetch_assoc();
            if (!empty($response) && md5($response['email']) == $_REQUEST['email']) {
                header("Location: ../userNewPassword.php?moduleMethod=user&module=userResetPass&email=" . $_REQUEST['email'] . "&reset_key=" . $_REQUEST['reset_key']);
            } else {
                $alert_type = "alert-danger";
                $alert_message = "Something went wrong please try again.";
                echo "<script>window.location.replace('../userForgotPassword.php?alert_type=" . $alert_type . "&alert_message=" . $alert_message . "');</script>";
            }
        }
    }

    // User Change Password
    if ($module == "userChangePass" && $moduleMethod == "user") {
        if (isset($_POST['userChangePasswordSub'])) {
            if (!empty($_POST['cureent_pwd']) && !empty($_POST['password']) && $_POST['confirm_password']) {
                $Condition['password']  = md5($_POST['cureent_pwd']);
                $Condition['id']  = $_SESSION["userId"];
                $Condition['email']  = $_SESSION["userEmail"];
                $response = getData($moduleMethod, $Condition);
                $response = $response->fetch_assoc();
                if (!empty($response)) {
                    $passwordChangeData = array(
                        'password' => md5($_POST['password']),
                        'reset_key' => 'NOT SET',
                        'reset_status' => 0,
                    );
                    $passwordChangeResponse = updateData($moduleMethod, $passwordChangeData, $Condition);
                    if (!empty($passwordChangeResponse)) {
                        $alert_type = "alert-success";
                        $alert_message = "Your password had been changed.";
                        echo "<script>window.location.replace('../userDashboard.php?dasboard=changepassword&alert_type=" . $alert_type . "&alert_message=" . $alert_message . "');</script>";
                    } else {
                        $alert_type = "alert-danger";
                        $alert_message = "Something went wrong please try again.";
                        echo "<script>window.location.replace('../userDashboard.php?alert_type=" . $alert_type . "&alert_message=" . $alert_message . "');</script>";
                    }
                } else {
                    $alert_type = "alert-danger";
                    $alert_message = "Cureent password is not matched.";
                    echo "<script>window.location.replace('../userDashboard.php?alert_type=" . $alert_type . "&alert_message=" . $alert_message . "');</script>";
                }
            }
        } else {
            $alert_type = "alert-danger";
            $alert_message = "Something went wrong please try again.";
            echo "<script>window.location.replace('../userDashboard.php?alert_type=" . $alert_type . "&alert_message=" . $alert_message . "');</script>";
        }
    }

    // User Detail Update
    if ($module == "userDetailUpdate" && $moduleMethod == "user") {
        if (isset($_POST['userDetailUpdateSub'])) {
            if (!empty($_FILES["profile_pic"]["tmp_name"])) {
                if (!empty($_POST['full_name']) && !empty($_SESSION["userId"]) && !empty($_SESSION["userEmail"])) {
                    $Condition['id']  = $_SESSION["userId"];
                    $Condition['email']  = $_SESSION["userEmail"];
                    $userDataResponse = getData($moduleMethod, $Condition);
                    $userDataResponse = $userDataResponse->fetch_assoc();
                    if ($userDataResponse["profile_pic"] != "userprofile.png") {
                        unlink($userProfilePath . $userDataResponse['profile_pic']);
                    }
                    $target_dir = $userProfilePath;
                    $target_file = $target_dir . basename($_FILES["profile_pic"]["name"]);
                    $uploadOk = 1;
                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                    // Check if image file is a actual image or fake image
                    $check = getimagesize($_FILES["profile_pic"]["tmp_name"]);
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
                    if ($_FILES["profile_pic"]["size"] > 500000) {
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
                        $extension = pathinfo($_FILES["profile_pic"]["name"], PATHINFO_EXTENSION);
                        $path = $userProfilePath . $userDataResponse['id'] . "." . $extension;
                        if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $path)) {
                            echo "The file " . htmlspecialchars(basename($_FILES["profile_pic"]["name"])) . " has been uploaded.";
                            $Condition['id']  = $_SESSION["userId"];
                            $Condition['email']  = $_SESSION["userEmail"];
                            $userDetailUpdateData = array(
                                'full_name' => $_POST['full_name'],
                                'mobile_no' => $_POST['mobile_no'],
                                'profile_pic' => $userDataResponse['id'] . "." . $extension,
                                'height' => $_POST['height'],
                                'weight' => $_POST['weight'],
                                'age' => $_POST['age'],
                            );
                            $userDetailUpdateResponse = updateData($moduleMethod, $userDetailUpdateData, $Condition);
                        } else {
                            echo "Sorry, there was an error uploading your file.";
                        }
                    }
                }
            } else {
                if (!empty($_POST['full_name']) && !empty($_SESSION["userId"]) && !empty($_SESSION["userEmail"])) {
                    $Condition['id']  = $_SESSION["userId"];
                    $Condition['email']  = $_SESSION["userEmail"];
                    $userDetailUpdateData = array(
                        'full_name' => $_POST['full_name'],
                        'mobile_no' => $_POST['mobile_no'],
                        'height' => $_POST['height'],
                        'weight' => $_POST['weight'],
                        'age' => $_POST['age'],
                    );
                    $userDetailUpdateResponse = updateData($moduleMethod, $userDetailUpdateData, $Condition);
                }
            }
            if (!empty($userDetailUpdateResponse)) {
                $alert_type = "alert-success";
                $alert_message = "Your details is updated.";
                echo "<script>window.location.replace('../userDashboard.php?alert_type=" . $alert_type . "&alert_message=" . $alert_message . "');</script>";
            } else {
                $alert_type = "alert-danger";
                $alert_message = "Something went wrong please try again.";
                echo "<script>window.location.replace('../userDashboard.php?alert_type=" . $alert_type . "&alert_message=" . $alert_message . "');</script>";
            }
        } else {
            $alert_type = "alert-danger";
            $alert_message = "Something went wrong please try again.";
            echo "<script>window.location.replace('../userDashboard.php?alert_type=" . $alert_type . "&alert_message=" . $alert_message . "');</script>";
        }
    }

    // User Change Password
    if ($module == "userChangePass" && $moduleMethod == "user") {
        if (isset($_POST['userChangePasswordSub'])) {
            if (!empty($_REQUEST['email']) && !empty($_REQUEST['reset_key']) && $_REQUEST['password'] == $_REQUEST['confirm_password']) {
                $Condition['reset_key']  = $_REQUEST['reset_key'];
                $Condition['reset_status']  = 1;
                $response = getData($moduleMethod, $Condition);
                $response = $response->fetch_assoc();
                if (!empty($response) && md5($response['email']) == $_REQUEST['email'] && $response['reset_key'] == $_REQUEST['reset_key']) {
                    $passwordRestData = array(
                        'password' => md5($_REQUEST['password']),
                        'reset_key' => 'NOT SET',
                        'reset_status' => 0,
                    );
                    $Condition['email'] = $response['email'];
                    $passwordRestResponse = updateData($moduleMethod, $passwordRestData, $Condition);

                    $alert_type = "alert-success";
                    $alert_message = "Your password had been changed.";
                    echo "<script>window.location.replace('../userLogin.php?alert_type=" . $alert_type . "&alert_message=" . $alert_message . "');</script>";
                } else {
                    $alert_type = "alert-danger";
                    $alert_message = "Something went wrong please try again.";
                    echo "<script>window.location.replace('../userForgotPassword.php?alert_type=" . $alert_type . "&alert_message=" . $alert_message . "');</script>";
                }
            }
        }
    }

    // User Logout
    if ($module == "userLogout" && $moduleMethod == "logout") {
        if ($_REQUEST['logout'] == 1) {
            session_unset();
            session_destroy();
            echo "<script>window.location.replace('../index.php');</script>";
        }
    }

    // Wishlist Add From Course
    if ($module == "wishlistAdd" && $moduleMethod == "wishlist") {
        if (!empty($_REQUEST['whislistId'])) {
            $uniqid = uniqid();
            $whishlistAddData = array(
                'id' => $uniqid,
                'user_id' => $_SESSION["userId"],
                'cource_id' => $_REQUEST['whislistId'],
                'date_entered' => date("Y-m-d H:i:s"),
                'date_modified' => date("Y-m-d H:i:s"),
                'modified_user_id' => $_SESSION["userId"],
                'created_by' => $_SESSION["userId"],
                'deleted' => 0,
            );
            $whishlistAddDataResponse = insertData($moduleMethod, $whishlistAddData);
            if (!empty($whishlistAddDataResponse)) {
                echo "<script>window.location.replace('../courseDetailView.php?view=" . $_REQUEST['whislistId'] . "');</script>";
            } else {
                $alert_type = "alert-danger";
                $alert_message = "Category is not updated.";
                echo "<script>window.location.replace('../index.php?alert_type=" . $alert_type . "&alert_message=" . $alert_message . "');</script>";
            }
        }
    }

    // Wishlist Delete Course
    if ($module == "wishlistDelete" && $moduleMethod == "wishlist") {
        if (!empty($_REQUEST['whislistId'])) {
            $Condition['cource_id'] = $_REQUEST['whislistId'];
            $Condition['user_id'] = $_SESSION["userId"];
            $wishlistDeleteResponse = deleteData($moduleMethod, $Condition);

            if (!empty($wishlistDeleteResponse)) {
                echo "<script>window.location.replace('../courseDetailView.php?view=" . $_REQUEST['whislistId'] . "');</script>";
            } else {
                $alert_type = "alert-danger";
                $alert_message = "Category is not updated.";
                echo "<script>window.location.replace('../index.php?alert_type=" . $alert_type . "&alert_message=" . $alert_message . "');</script>";
            }
        }
    }

    // Cartlist Add From Course
    if ($module == "cartAdd" && $moduleMethod == "cart") {
        if (!empty($_REQUEST['cartId'])) {
            $uniqid = uniqid();
            // echo "The user IP Address is - " . $ip;
            if (!empty($_SESSION["userId"])) {
                $cartAddData = array(
                    'id' => $uniqid,
                    'user_id' => $_SESSION["userId"],
                    'user_ip' => $ip,
                    'cource_id' => $_REQUEST['cartId'],
                    'date_entered' => date("Y-m-d H:i:s"),
                    'date_modified' => date("Y-m-d H:i:s"),
                    'modified_user_id' => $_SESSION["userId"],
                    'created_by' => $_SESSION["userId"],
                    'deleted' => 0,
                );
            } else {
                $cartAddData = array(
                    'id' => $uniqid,
                    'user_ip' => $ip,
                    'cource_id' => $_REQUEST['cartId'],
                    'date_entered' => date("Y-m-d H:i:s"),
                    'date_modified' => date("Y-m-d H:i:s"),
                    'modified_user_id' => $ip,
                    'created_by' => $ip,
                    'deleted' => 0,
                );
            }
            $cartAddDataResponse = insertData($moduleMethod, $cartAddData);
            if (!empty($cartAddDataResponse)) {
                echo "<script>window.location.replace('../courseDetailView.php?view=" . $_REQUEST['cartId'] . "');</script>";
            } else {
                $alert_type = "alert-danger";
                $alert_message = "Category is not updated.";
                echo "<script>window.location.replace('../index.php?alert_type=" . $alert_type . "&alert_message=" . $alert_message . "');</script>";
            }
        }
    }

    // Add To Cart From Wishlist Sidebar
    if ($module == "addToCartFromWishlist" && $moduleMethod == "wishlist") {
        if (!empty($_REQUEST['cource_id'])) {
            $uniqid = uniqid();
            $cartAddData = array(
                'id' => $uniqid,
                'user_id' => $_SESSION["userId"],
                'user_ip' => $ip,
                'cource_id' => $_REQUEST['cource_id'],
                'date_entered' => date("Y-m-d H:i:s"),
                'date_modified' => date("Y-m-d H:i:s"),
                'modified_user_id' => $_SESSION["userId"],
                'created_by' => $_SESSION["userId"],
                'deleted' => 0,
            );
            $cartAddDataResponse = insertData('cart', $cartAddData);
            if (!empty($cartAddDataResponse)) {
                $Condition['cource_id'] = $_REQUEST['cource_id'];
                $Condition['user_id'] = $_SESSION["userId"];
                $wishlistDeleteResponse = deleteData($moduleMethod, $Condition);
                if (!empty($wishlistDeleteResponse)) {
                    // print_r($wishlistDeleteResponse);
                    header("Location: ../loadWishlist.php");
                }
            }
        } else {
            echo "<script>alert('Something want wrong please try again!.');</script>";
        }
    }

    // Delete Wishlist From Sidebar
    if ($module == "deleteFromWishlist" && $moduleMethod == "wishlist") {
        if (!empty($_REQUEST['cource_id'])) {
            if (!empty($_SESSION["userId"]) && !empty($_SESSION["userEmail"])) {
                $Condition['user_id'] = $_SESSION["userId"];
                $Condition['cource_id'] = $_REQUEST['cource_id'];
                $deleteFromWishlist = deleteData($moduleMethod, $Condition);

                if (!empty($deleteFromWishlist)) {
                    header("Location: ../loadWishlist.php");
                }
            }
        } else {
            echo "<script>alert('Something want wrong please try again!.');</script>";
        }
    }

    // Delete Course From Dashboard Cart 
    if ($module == "deleteCourseFromDashboard" && $moduleMethod == "cart") {
        if (!empty($_REQUEST['cource_id'])) {
            if (empty($_SESSION["userId"]) && empty($_SESSION["userEmail"])) {
                $Condition['user_ip'] = $ip;
                $Condition['user_id'] = null;
                $Condition['cource_id'] = $_REQUEST['cource_id'];
                $deleteFromCarlist = deleteData($moduleMethod, $Condition);

                if (!empty($deleteFromCarlist)) {
                    header("Location: ../loadCartlist.php");
                }
            } else {
                $Condition['user_ip'] = $ip;
                $Condition['user_id'] = $_SESSION["userId"];
                $Condition['cource_id'] = $_REQUEST['cource_id'];
                $deleteFromCarlist = deleteData($moduleMethod, $Condition);

                if (!empty($deleteFromCarlist)) {
                    header("Location: ../loadCartlist.php");
                }
            }
        } else {
            echo "<script>alert('Something want wrong please try again!.');</script>";
        }
    }
}
