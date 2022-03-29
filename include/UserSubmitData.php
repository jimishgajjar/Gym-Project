<?php
include 'dbConfig.php';
include "queryFunction.php";
session_start();
date_default_timezone_set("Asia/Kolkata");

$moduleMethod = $_REQUEST['moduleMethod'];
$module = $_REQUEST['module'];

$ip = getIPAddress();

$userProfilePath = "../assets/userprofile/";


if (!empty($_REQUEST['moduleMethod'])) {
    // User Sign Up
    if ($module == "userSignup" && $moduleMethod == "user") {
        if (isset($_POST['userSignupSub'])) {
            $Condition['email'] = $_POST["email"];
            $Condition['mobile_no'] = $_POST["mobile_no"];
            $response = getData('user', $Condition);
            $response = $response->fetch_assoc();
            if (empty($response)) {
                $uniqid = uniqid();
                $userData = array(
                    'id' => $uniqid,
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
                $userReportData = array(
                    'id' => uniqid(),
                    'user_id' => $uniqid,
                    'weight' => $_POST['weight'],
                    'reg_month' => date("m"),
                    'reg_year' => date("Y"),
                    'date_entered' => date("Y-m-d H:i:s"),
                    'date_modified' => date("Y-m-d H:i:s"),
                    'modified_user_id' => $uniqid,
                    'created_by' => $uniqid,
                    'deleted' => 0,
                );
                if (!empty($userData) && !empty($userReportData)) {
                    $response = insertData($moduleMethod, $userData);
                    $userReport = insertData("user_report", $userReportData);
                    if (!empty($response) && !empty($userReport)) {
                        setcookie('UserLogin', 'welcome', time() + (86400 * 30), "/"); // 86400 = 1 day

                        if (isset($_COOKIE['cartCookie']) && !empty(json_decode($_COOKIE['cartCookie']))) {
                            $cartArray = json_decode($_COOKIE['cartCookie']);

                            foreach ($cartArray as $course_id) {
                                $cartAddData = array(
                                    'id' => uniqid(),
                                    'user_id' => $uniqid,
                                    'user_ip' => $ip,
                                    'course_id' => $course_id,
                                    'date_entered' => date("Y-m-d H:i:s"),
                                    'date_modified' => date("Y-m-d H:i:s"),
                                    'modified_user_id' => $uniqid,
                                    'created_by' => $uniqid,
                                    'deleted' => 0,
                                );
                                $cartAddDataResponse = insertData('cart', $cartAddData);
                            }
                            setcookie('cartCookie', "", time() + (86400), "/"); // 86400 = 1 day
                        }
                        if ($_SESSION["withoutLogin"] == "withoutLogin" && isset($_REQUEST['checkbuy']) && !empty($_REQUEST['checkbuy']) && $_REQUEST['checkbuy'] == "buynow" && isset($_REQUEST['buynow']) && !empty($_REQUEST['buynow'])) {
                            $_SESSION["userId"] = $uniqid;
                            $_SESSION["userEmail"] = $_POST['email'];
                            echo "<script>window.location.replace('../payment.php?checkbuy=buynow&buynow=" . $_REQUEST['buynow'] . "');</script>";
                        } elseif ($_SESSION["withoutLogin"] == "withoutLogin" && isset($_REQUEST['checkbuy']) && !empty($_REQUEST['checkbuy']) && $_REQUEST['checkbuy'] == "cart") {
                            $_SESSION["userId"] = $uniqid;
                            $_SESSION["userEmail"] = $_POST['email'];
                            echo "<script>window.location.replace('../userDashboard.php?dasboard=cartlist');</script>";
                        } else {
                            echo "<script>window.location.replace('../index.php');</script>";
                        }
                    }
                } else {
                    $alert_type = "alert-danger";
                    $alert_message = "Something want wrong <span>please try again!</span>";
                    echo "<script>window.location.replace('../userSignUp.php?alert_type=" . $alert_type . "&alert_message=" . $alert_message . "');</script>";
                }
            } else {
                $alert_type = "alert-danger";
                $alert_message = "Email id Or Mobile no already exist.";
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
                    setcookie("UserLogin", "welcome", time() + (86400), "/"); // 86400 = 1 day

                    if (isset($_COOKIE['cartCookie']) && !empty(json_decode($_COOKIE['cartCookie']))) {
                        $cartArray = json_decode($_COOKIE['cartCookie']);

                        foreach ($cartArray as $course_id) {
                            $CartCondition['user_id'] = $response['id'];
                            $CartCondition['course_id']  = $course_id;
                            $CartResponse = getData('cart', $CartCondition);
                            $CartResponse = $CartResponse->fetch_assoc();
                            if (empty($CartResponse)) {
                                $cartAddData = array(
                                    'id' => uniqid(),
                                    'user_id' => $response['id'],
                                    'user_ip' => $ip,
                                    'course_id' => $course_id,
                                    'date_entered' => date("Y-m-d H:i:s"),
                                    'date_modified' => date("Y-m-d H:i:s"),
                                    'modified_user_id' => $response['id'],
                                    'created_by' => $response['id'],
                                    'deleted' => 0,
                                );
                                $cartAddDataResponse = insertData('cart', $cartAddData);
                            }
                        }
                        setcookie('cartCookie', "", time() + (86400), "/"); // 86400 = 1 day
                    }
                    if ($_SESSION["withoutLogin"] == "withoutLogin" && isset($_REQUEST['checkbuy']) && !empty($_REQUEST['checkbuy']) && $_REQUEST['checkbuy'] == "buynow" && isset($_REQUEST['buynow']) && !empty($_REQUEST['buynow'])) {
                        $_SESSION["userId"] = $response['id'];
                        $_SESSION["userEmail"] = $response['email'];

                        $checkCourseExist = getData('user_courses', $CartCondition);
                        if (empty($checkCourseExist)) {
                            echo "<script>window.location.replace('../payment.php?checkbuy=buynow&buynow=" . $_REQUEST['buynow'] . "');</script>";
                        } else {
                            $alert_type = "alert-danger";
                            $alert_message = "Course you want to buy is already in your list.";
                            echo "<script>window.location.replace('../index.php?dasboard=mycourse&alert_type=" . $alert_type . "&alert_message=" . $alert_message . "');</script>";
                        }
                    } elseif ($_SESSION["withoutLogin"] == "withoutLogin" && isset($_REQUEST['checkbuy']) && !empty($_REQUEST['checkbuy']) && $_REQUEST['checkbuy'] == "cart") {
                        $_SESSION["userId"] = $response['id'];
                        $_SESSION["userEmail"] = $response['email'];
                        echo "<script>window.location.replace('../userDashboard.php?dasboard=cartlist');</script>";
                    } else {
                        $_SESSION["userId"] = $response['id'];
                        $_SESSION["userEmail"] = $response['email'];
                        echo "<script>window.location.replace('../index.php');</script>";
                    }
                } else {
                    $alert_type = "alert-danger";
                    $alert_message = "Incorrect username or password.";
                    if ($_SESSION["withoutLogin"] == "withoutLogin" && isset($_REQUEST['checkbuy']) && !empty($_REQUEST['checkbuy']) && $_REQUEST['checkbuy'] == "buynow" && isset($_REQUEST['buynow']) && !empty($_REQUEST['buynow'])) {
                        echo "<script>window.location.replace('../userLogin.php?checkbuy=buynow&buynow=" . $_REQUEST['buynow'] . "&withoutLogin=withoutLogin&alert_type=" . $alert_type . "&alert_message=" . $alert_message . "');</script>";
                    } elseif ($_SESSION["withoutLogin"] == "withoutLogin" && isset($_REQUEST['checkbuy']) && !empty($_REQUEST['checkbuy']) && $_REQUEST['checkbuy'] == "cart") {
                        echo "<script>window.location.replace('../userLogin.php?checkbuy=cart&withoutLogin=withoutLogin&alert_type=" . $alert_type . "&alert_message=" . $alert_message . "');</script>";
                    } else {
                        echo "<script>window.location.replace('../userLogin.php?withoutLogin=withoutLogin&alert_type=" . $alert_type . "&alert_message=" . $alert_message . "');</script>";
                    }
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
                        $alert_message = "Something want wrong <span>please try again!</span>";
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
                $alert_message = "Something want wrong <span>please try again!</span>";
                echo "<script>window.location.replace('../userForgotPassword.php?alert_type=" . $alert_type . "&alert_message=" . $alert_message . "');</script>";
            }
        }
    }

    // User Reset Password
    if ($module == "userResetPass" && $moduleMethod == "user") {
        if (isset($_POST['userResetPasswordSub'])) {
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
                    $alert_message = "Something want wrong <span>please try again!</span>";
                    echo "<script>window.location.replace('../userForgotPassword.php?alert_type=" . $alert_type . "&alert_message=" . $alert_message . "');</script>";
                }
            }
        }
    }

    // User Logout
    if ($module == "userLogout" && $moduleMethod == "logout") {
        if ($_REQUEST['logout'] == 1) {
            setcookie('UserLogin', 'notwelcome', time() + (86400 * 30), "/"); // 86400 = 1 day
            session_unset();
            session_destroy();
            echo "<script>window.location.replace('../index.php');</script>";
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
                echo "<script>window.location.replace('../userDashboard.php?dasboard=userprofile&alert_type=" . $alert_type . "&alert_message=" . $alert_message . "');</script>";
            } else {
                $alert_type = "alert-danger";
                $alert_message = "Something want wrong <span>please try again!</span>";
                echo "<script>window.location.replace('../userDashboard.php?dasboard=userprofile&alert_type=" . $alert_type . "&alert_message=" . $alert_message . "');</script>";
            }
        } else {
            $alert_type = "alert-danger";
            $alert_message = "Something want wrong <span>please try again!</span>";
            echo "<script>window.location.replace('../userDashboard.php?dasboard=userprofile&alert_type=" . $alert_type . "&alert_message=" . $alert_message . "');</script>";
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
                        $alert_message = "Something want wrong <span>please try again!</span>";
                        echo "<script>window.location.replace('../userDashboard.php?dasboard=changepassword&alert_type=" . $alert_type . "&alert_message=" . $alert_message . "');</script>";
                    }
                } else {
                    $alert_type = "alert-danger";
                    $alert_message = "Cureent password is not matched.";
                    echo "<script>window.location.replace('../userDashboard.php?dasboard=changepassword&alert_type=" . $alert_type . "&alert_message=" . $alert_message . "');</script>";
                }
            }
        } else {
            $alert_type = "alert-danger";
            $alert_message = "Something want wrong <span>please try again!</span>";
            echo "<script>window.location.replace('../userDashboard.php?dasboard=changepassword&alert_type=" . $alert_type . "&alert_message=" . $alert_message . "');</script>";
        }
    }

    // Wishlist Add From Course
    if ($module == "wishlistAdd" && $moduleMethod == "wishlist") {
        if (!empty($_REQUEST['whislistId'])) {
            $uniqid = uniqid();
            $whishlistAddData = array(
                'id' => $uniqid,
                'user_id' => $_SESSION["userId"],
                'course_id' => $_REQUEST['whislistId'],
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
                $alert_message = "Something want wrong <span>please try again!</span>";
                echo "<script>window.location.replace('../courseDetailView.php?view=" . $_REQUEST['whislistId'] . "&alert_type=" . $alert_type . "&alert_message=" . $alert_message . "');</script>";
            }
        }
    }

    // Wishlist Delete From Course & Dashboard
    if ($module == "wishlistDelete" && $moduleMethod == "wishlist") {
        if (!empty($_REQUEST['whislistId'])) {
            $Condition['course_id'] = $_REQUEST['whislistId'];
            $Condition['user_id'] = $_SESSION["userId"];
            $wishlistDeleteResponse = deleteData($moduleMethod, $Condition);

            if (!empty($wishlistDeleteResponse)) {
                echo "<script>window.location.replace('../courseDetailView.php?view=" . $_REQUEST['whislistId'] . "');</script>";
            } else {
                $alert_type = "alert-danger";
                $alert_message = "Something want wrong <span>please try again!</span>";
                echo "<script>window.location.replace('../index.php?alert_type=" . $alert_type . "&alert_message=" . $alert_message . "');</script>";
            }
        }


        if (!empty($_REQUEST['whislistIdFromDash'])) {
            $Condition['course_id'] = $_REQUEST['whislistIdFromDash'];
            $Condition['user_id'] = $_SESSION["userId"];
            $wishlistDeleteResponse = deleteData($moduleMethod, $Condition);

            if (!empty($wishlistDeleteResponse)) {
                $alert_type = "alert-success";
                $alert_message = "Course removed from wishlist.";
                echo "<script>window.location.replace('../userDashboard.php?dasboard=wishlist&alert_type=" . $alert_type . "&alert_message=" . $alert_message . "');</script>";
            } else {
                $alert_type = "alert-danger";
                $alert_message = "Something want wrong <span>please try again!</span>";
                echo "<script>window.location.replace('../userDashboard.php?dasboard=wishlist&alert_type=" . $alert_type . "&alert_message=" . $alert_message . "');</script>";
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
                    'course_id' => $_REQUEST['cartId'],
                    'date_entered' => date("Y-m-d H:i:s"),
                    'date_modified' => date("Y-m-d H:i:s"),
                    'modified_user_id' => $_SESSION["userId"],
                    'created_by' => $_SESSION["userId"],
                    'deleted' => 0,
                );
                $cartAddDataResponse = insertData($moduleMethod, $cartAddData);
                if (!empty($cartAddDataResponse)) {
                    echo "<script>window.location.replace('../courseDetailView.php?view=" . $_REQUEST['cartId'] . "');</script>";
                } else {
                    $alert_type = "alert-danger";
                    $alert_message = "Something want wrong <span>please try again!</span>";
                    echo "<script>window.location.replace('../index.php?alert_type=" . $alert_type . "&alert_message=" . $alert_message . "');</script>";
                }
            } else {
                $cartArray = array();
                if (!isset($_COOKIE['cartCookie'])) {
                    array_push($cartArray, $_REQUEST['cartId']);
                    setcookie('cartCookie', json_encode($cartArray), time() + (86400), "/"); // 86400 = 1 day
                } else {
                    $cartArray = json_decode($_COOKIE['cartCookie']);
                    array_push($cartArray, $_REQUEST['cartId']);
                    setcookie('cartCookie', json_encode($cartArray), time() + (86400), "/"); // 86400 = 1 day
                }
                if (!empty($cartArray)) {
                    echo "<script>window.location.replace('../courseDetailView.php?view=" . $_REQUEST['cartId'] . "');</script>";
                } else {
                    $alert_type = "alert-danger";
                    $alert_message = "Something want wrong <span>please try again!</span>";
                    echo "<script>window.location.replace('../index.php?alert_type=" . $alert_type . "&alert_message=" . $alert_message . "');</script>";
                }
            }
        } else {
            $alert_type = "alert-danger";
            $alert_message = "Something want wrong <span>please try again!</span>";
            echo "<script>window.location.replace('../index.php?alert_type=" . $alert_type . "&alert_message=" . $alert_message . "');</script>";
        }
    }

    // Add To Cart From Wishlist Sidebar
    if ($module == "addToCartFromWishlist" && $moduleMethod == "wishlist") {
        if (!empty($_REQUEST['course_id'])) {
            $uniqid = uniqid();
            $cartAddData = array(
                'id' => $uniqid,
                'user_id' => $_SESSION["userId"],
                'user_ip' => $ip,
                'course_id' => $_REQUEST['course_id'],
                'date_entered' => date("Y-m-d H:i:s"),
                'date_modified' => date("Y-m-d H:i:s"),
                'modified_user_id' => $_SESSION["userId"],
                'created_by' => $_SESSION["userId"],
                'deleted' => 0,
            );
            $cartAddDataResponse = insertData('cart', $cartAddData);
            if (!empty($cartAddDataResponse)) {
                $Condition['course_id'] = $_REQUEST['course_id'];
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
        if (!empty($_REQUEST['course_id'])) {
            if (!empty($_SESSION["userId"]) && !empty($_SESSION["userEmail"])) {
                $Condition['user_id'] = $_SESSION["userId"];
                $Condition['course_id'] = $_REQUEST['course_id'];
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
    if ($module == "deleteCartFromDash" && $moduleMethod == "cart") {
        if (!empty($_REQUEST['remove'])) {
            if (!empty($_SESSION["userId"]) && !empty($_SESSION["userEmail"])) {
                $Condition['id'] = $_REQUEST['remove'];
                $Condition['user_id'] = $_SESSION["userId"];
                $deleteFromCartlist = deleteData($moduleMethod, $Condition);
            } else {
                if (isset($_COOKIE['cartCookie']) && !empty(json_decode($_COOKIE['cartCookie']))) {
                    $cartArray = json_decode($_COOKIE['cartCookie']);
                    unset($cartArray[array_search($_REQUEST['remove'], $cartArray)]);
                    setcookie('cartCookie', json_encode($cartArray), time() + (86400), "/"); // 86400 = 1 day
                    $deleteFromCartlist = "deleted successfully";
                }
            }

            if (!empty($deleteFromCartlist)) {
                $alert_type = "alert-success";
                $alert_message = "Course remove successfully.";
                if (!empty($_SESSION["userId"]) && !empty($_SESSION["userEmail"])) {
                    echo "<script>window.location.replace('../userDashboard.php?dasboard=cartlist&alert_type=" . $alert_type . "&alert_message=" . $alert_message . "');</script>";
                } else {
                    echo "<script>window.location.replace('../checkout.php');</script>";
                }
            } else {
                $alert_type = "alert-danger";
                $alert_message = "Something want wrong <span>please try again!</span>";
                if (!empty($_SESSION["userId"]) && !empty($_SESSION["userEmail"])) {
                    echo "<script>window.location.replace('../userDashboard.php?dasboard=cartlist&alert_type=" . $alert_type . "&alert_message=" . $alert_message . "');</script>";
                } else {
                    echo "<script>window.location.replace('../checkout.php');</script>";
                }
            }
        } else {
            $alert_type = "alert-danger";
            $alert_message = "Something want wrong <span>please try again!</span>";
            if (!empty($_SESSION["userId"]) && !empty($_SESSION["userEmail"])) {
                echo "<script>window.location.replace('../userDashboard.php?dasboard=cartlist&alert_type=" . $alert_type . "&alert_message=" . $alert_message . "');</script>";
            } else {
                echo "<script>window.location.replace('../checkout.php');</script>";
            }
        }
    }

    // Move Course From Dashboard Cart to Wishlist
    if ($module == "moveCartToWishlistDash" && $moduleMethod == "wishlist") {
        if (!empty($_REQUEST['course_id']) && !empty($_SESSION["userId"]) && !empty($_SESSION["userEmail"])) {
            $Condition['user_ip'] = $ip;
            $Condition['user_id'] = $_SESSION["userId"];
            $Condition['course_id'] = $_REQUEST['course_id'];
            $moveCartToWishlist = deleteData("cart", $Condition);
            if (!empty($moveCartToWishlist)) {
                $uniqid = uniqid();
                $whishlistAddData = array(
                    'id' => $uniqid,
                    'user_id' => $_SESSION["userId"],
                    'course_id' => $_REQUEST['course_id'],
                    'date_entered' => date("Y-m-d H:i:s"),
                    'date_modified' => date("Y-m-d H:i:s"),
                    'modified_user_id' => $_SESSION["userId"],
                    'created_by' => $_SESSION["userId"],
                    'deleted' => 0,
                );
                $whishlistAddDataResponse = insertData($moduleMethod, $whishlistAddData);
                if (!empty($whishlistAddDataResponse)) {
                    $alert_type = "alert-success";
                    $alert_message = "Course move to wishlist.";
                    echo "<script>window.location.replace('../userDashboard.php?dasboard=cartlist&alert_type=" . $alert_type . "&alert_message=" . $alert_message . "');</script>";
                } else {
                    $alert_type = "alert-danger";
                    $alert_message = "Something want wrong <span>please try again!</span>";
                    echo "<script>window.location.replace('../userDashboard.php?dasboard=cartlist&alert_type=" . $alert_type . "&alert_message=" . $alert_message . "');</script>";
                }
            }
        } else {
            $alert_type = "alert-danger";
            $alert_message = "Something want wrong <span>please try again!</span>";
            echo "<script>window.location.replace('../userDashboard.php?dasboard=cartlist&alert_type=" . $alert_type . "&alert_message=" . $alert_message . "');</script>";
        }
    }

    // Move Course From Dashboard Wishlist to Cart
    if ($module == "moveWishToCartDash" && $moduleMethod == "cart") {
        if (!empty($_REQUEST['Dashcourse_id']) && !empty($_SESSION["userId"]) && !empty($_SESSION["userEmail"])) {
            $Condition['user_id'] = $_SESSION["userId"];
            $Condition['course_id'] = $_REQUEST['Dashcourse_id'];
            $moveWishlistToCart = deleteData("wishlist", $Condition);
            if (!empty($moveWishlistToCart)) {
                $uniqid = uniqid();
                $cartAddData = array(
                    'id' => $uniqid,
                    'user_id' => $_SESSION["userId"],
                    'user_ip' => $ip,
                    'course_id' => $_REQUEST['Dashcourse_id'],
                    'date_entered' => date("Y-m-d H:i:s"),
                    'date_modified' => date("Y-m-d H:i:s"),
                    'modified_user_id' => $_SESSION["userId"],
                    'created_by' => $_SESSION["userId"],
                    'deleted' => 0,
                );
                $cartAddDataResponse = insertData($moduleMethod, $cartAddData);
                if (!empty($cartAddDataResponse)) {
                    $alert_type = "alert-success";
                    $alert_message = "Course move to cart.";
                    echo "<script>window.location.replace('../userDashboard.php?dasboard=wishlist&alert_type=" . $alert_type . "&alert_message=" . $alert_message . "');</script>";
                } else {
                    $alert_type = "alert-danger";
                    $alert_message = "Something want wrong <span>please try again!</span>";
                    echo "<script>window.location.replace('../userDashboard.php?dasboard=wishlist&alert_type=" . $alert_type . "&alert_message=" . $alert_message . "');</script>";
                }
            }
        } else {
            $alert_type = "alert-danger";
            $alert_message = "Something want wrong <span>please try again!</span>";
            echo "<script>window.location.replace('../userDashboard.php?dasboard=wishlist&alert_type=" . $alert_type . "&alert_message=" . $alert_message . "');</script>";
        }
    }

    // User Course Payment
    if ($module == "coursesPayment" && $moduleMethod == "payment") {
        $total = 0;
        $totalAll = 0;
        $discountAmount = 0;

        $cartListCondition['user_id'] = $_SESSION["userId"];
        /* Payment from direct buy now */
        if (isset($_POST['buynow']) && !empty($_POST['buynow']) && isset($_POST['checkbuy']) && $_POST['checkbuy'] == 'buynow') {
            $payment_status = "Complete";
            if ($payment_status == "Complete") {
                $payment_uniqid = uniqid();
                $userPaymentData = array(
                    'id' => $payment_uniqid,
                    'user_id' => $_SESSION["userId"],
                    'transection_id' => "Test Demo",
                    'transection_status' => $payment_status,
                    'transection_date' => date("Y-m-d H:i:s"),
                    'date_entered' => date("Y-m-d H:i:s"),
                    'date_modified' => date("Y-m-d H:i:s"),
                    'modified_user_id' => $_SESSION["userId"],
                    'created_by' => $_SESSION["userId"],
                    'deleted' => 0,
                );
                $userPaymentDataResponse = insertData($moduleMethod, $userPaymentData);

                if (!empty($userPaymentDataResponse)) {
                    $courseDiscountAmount = 0;
                    $courseDiscountPrice = 0;
                    $courseTotal = 0;
                    $courseTotalAll = 0;
                    // $userCartData = getData('cart', $cartListCondition);

                    $Condition['id'] = $_POST['buynow'];
                    $response = getData('course', $Condition);
                    $response = $response->fetch_assoc();
                    if (!empty($response)) {
                        if ($response['discount'] != 0) {
                            $courseDiscountAmount = ($response['price'] * $response['discount'] / 100);
                            $courseDiscountPrice = $response['price'] - ($response['price'] * $response['discount'] / 100);
                        } else {
                            $courseDiscountPrice = $response['price'];
                        }
                    }

                    $userCoursesData = array(
                        'id' => uniqid(),
                        'user_id' => $_SESSION["userId"],
                        'course_id' => $_POST['buynow'],
                        'course_amount' => $response['price'],
                        'discount_given' => $courseDiscountAmount,
                        'final_amount' => $courseDiscountPrice,
                        'payment_id' => $payment_uniqid,
                        'payment_date' => date("Y-m-d H:i:s"),
                        'date_entered' => date("Y-m-d H:i:s"),
                        'date_modified' => date("Y-m-d H:i:s"),
                        'modified_user_id' => $_SESSION["userId"],
                        'created_by' => $_SESSION["userId"],
                        'deleted' => 0,
                    );
                    $userCoursesResponse = insertData("user_courses", $userCoursesData);
                    $courseDeleteCondition['user_id'] = $_SESSION["userId"];
                    $courseDeleteCondition['course_id'] = $_POST['buynow'];
                    $cartCoursesDelete = deleteData("cart", $courseDeleteCondition);
                    $wishListCoursesDelete = deleteData('wishlist', $courseDeleteCondition);

                    if (!empty($userCoursesResponse) && !empty($cartCoursesDelete) && !empty($wishListCoursesDelete)) {
                        $alert_type = "alert-success";
                        $alert_message = "Payment successful.";
                        echo "<script>window.location.replace('../userDashboard.php?dasboard=mycourse&alert_type=" . $alert_type . "&alert_message=" . $alert_message . "');</script>";
                    } else {
                        $alert_type = "alert-danger";
                        $alert_message = "Something want wrong <span>please try again!</span>";
                        echo "<script>window.location.replace('../userDashboard.php?dasboard=userprofile&alert_type=" . $alert_type . "&alert_message=" . $alert_message . "');</script>";
                    }
                } else {
                    $alert_type = "alert-danger";
                    $alert_message = "Something want wrong <span>please try again!</span>";
                    echo "<script>window.location.replace('../userDashboard.php?dasboard=userprofile&alert_type=" . $alert_type . "&alert_message=" . $alert_message . "');</script>";
                }
            } else {
                $alert_type = "alert-danger";
                $alert_message = "Something want wrong <span>please try again!</span>";
                echo "<script>window.location.replace('../userDashboard.php?dasboard=userprofile&alert_type=" . $alert_type . "&alert_message=" . $alert_message . "');</script>";
            }
        }

        /* Payment from cart */
        if (isset($_POST['checkbuy']) && $_POST['checkbuy'] == 'cart') {
            $payment_status = "Complete";
            if ($payment_status == "Complete") {
                $payment_uniqid = uniqid();
                $userPaymentData = array(
                    'id' => $payment_uniqid,
                    'user_id' => $_SESSION["userId"],
                    'transection_id' => "Test Demo",
                    'transection_status' => $payment_status,
                    'transection_date' => date("Y-m-d H:i:s"),
                    'date_entered' => date("Y-m-d H:i:s"),
                    'date_modified' => date("Y-m-d H:i:s"),
                    'modified_user_id' => $_SESSION["userId"],
                    'created_by' => $_SESSION["userId"],
                    'deleted' => 0,
                );
                $userPaymentDataResponse = insertData($moduleMethod, $userPaymentData);

                if (!empty($userPaymentDataResponse)) {
                    $courseDiscountAmount = 0;
                    $courseDiscountPrice = 0;
                    $courseTotal = 0;
                    $courseTotalAll = 0;
                    // $userCartData = getData('cart', $cartListCondition);
                    $userCartData = getData('cart', $cartListCondition);
                    if ($userCartData->num_rows > 0) {
                        while ($row = $userCartData->fetch_assoc()) {
                            $Condition['id'] = $row['course_id'];
                            $response = getData('course', $Condition);
                            $response = $response->fetch_assoc();
                            if (!empty($response)) {
                                if ($response['discount'] != 0) {
                                    $courseDiscountAmount = ($response['price'] * $response['discount'] / 100);
                                    $courseDiscountPrice = $response['price'] - ($response['price'] * $response['discount'] / 100);
                                } else {
                                    $courseDiscountPrice = $response['price'];
                                }
                            }

                            $userCoursesData = array(
                                'id' => uniqid(),
                                'user_id' => $_SESSION["userId"],
                                'course_id' => $row['course_id'],
                                'course_amount' => $response['price'],
                                'discount_given' => $courseDiscountAmount,
                                'final_amount' => $courseDiscountPrice,
                                'payment_id' => $payment_uniqid,
                                'payment_date' => date("Y-m-d H:i:s"),
                                'date_entered' => date("Y-m-d H:i:s"),
                                'date_modified' => date("Y-m-d H:i:s"),
                                'modified_user_id' => $_SESSION["userId"],
                                'created_by' => $_SESSION["userId"],
                                'deleted' => 0,
                            );
                            $userCoursesResponse = insertData("user_courses", $userCoursesData);
                            $courseDeleteCondition['user_id'] = $_SESSION["userId"];
                            $courseDeleteCondition['course_id'] = $row['course_id'];
                            $cartCoursesDelete = deleteData("cart", $courseDeleteCondition);
                            $wishListCoursesDelete = deleteData('wishlist', $courseDeleteCondition);
                        }
                    }
                    if (!empty($userCoursesResponse) && !empty($cartCoursesDelete) && !empty($wishListCoursesDelete)) {
                        $alert_type = "alert-success";
                        $alert_message = "Payment successful.";
                        echo "<script>window.location.replace('../userDashboard.php?dasboard=mycourse&alert_type=" . $alert_type . "&alert_message=" . $alert_message . "');</script>";
                    } else {
                        $alert_type = "alert-danger";
                        $alert_message = "Something want wrong <span>please try again!</span>";
                        echo "<script>window.location.replace('../userDashboard.php?dasboard=userprofile&alert_type=" . $alert_type . "&alert_message=" . $alert_message . "');</script>";
                    }
                } else {
                    $alert_type = "alert-danger";
                    $alert_message = "Something want wrong <span>please try again!</span>";
                    echo "<script>window.location.replace('../userDashboard.php?dasboard=userprofile&alert_type=" . $alert_type . "&alert_message=" . $alert_message . "');</script>";
                }
            } else {
                $alert_type = "alert-danger";
                $alert_message = "Something want wrong <span>please try again!</span>";
                echo "<script>window.location.replace('../userDashboard.php?dasboard=userprofile&alert_type=" . $alert_type . "&alert_message=" . $alert_message . "');</script>";
            }
        }
    }

    // User Review Insert
    if ($module == "course_reviewAdd" && $moduleMethod == "course_review") {
        if (isset($_POST['reviewSub'])) {
            if (isset($_POST['edit'])) {
                $reviewData = array(
                    'course_id' => $_POST["course_id"],
                    'user_id' => $_SESSION["userId"],
                    'rating' => $_POST['rating'],
                    'title' => $_POST['title'],
                    'description' => $_POST['description'],
                    'date_modified' => date("Y-m-d H:i:s"),
                    'modified_user_id' => $_SESSION["userId"],
                    'deleted' => 0,
                );
                $reviewUpdateCondition['id'] = $_POST['edit'];
                $reviewDataResponse = updateData($moduleMethod, $reviewData, $reviewUpdateCondition);
            } else {
                $reviewData = array(
                    'id' => uniqid(),
                    'course_id' => $_POST["course_id"],
                    'user_id' => $_SESSION["userId"],
                    'rating' => $_POST['rating'],
                    'title' => $_POST['title'],
                    'description' => $_POST['description'],
                    'date_entered' => date("Y-m-d H:i:s"),
                    'date_modified' => date("Y-m-d H:i:s"),
                    'modified_user_id' => $_SESSION["userId"],
                    'created_by' => $_SESSION["userId"],
                    'deleted' => 0,
                );
                $reviewDataResponse = insertData($moduleMethod, $reviewData);
            }
            $overallReviewQuery = "SELECT COUNT(rating), rating, course_id FROM course_review where course_id='" . $_POST["course_id"] . "' GROUP BY rating";
            $overallReview = $conn->query($overallReviewQuery);
            $Scoretotal = 0;
            $Responsetotal = 0;
            $overallRateing = 0;
            while ($overallReviewRow = $overallReview->fetch_assoc()) {
                $Scoretotal += $overallReviewRow['COUNT(rating)'] * $overallReviewRow['rating'];
                $Responsetotal += $overallReviewRow['COUNT(rating)'];
            }

            $overallRateing = $Scoretotal / $Responsetotal;
            $overallRateingData = array(
                'rating' => $overallRateing,
                'date_modified' => date("Y-m-d H:i:s"),
                'modified_user_id' => $_SESSION["userId"],
                'deleted' => 0,
            );
            $overallRateingCondition['id'] = $_POST["course_id"];
            $overallRateingResponse = updateData('course', $overallRateingData, $overallRateingCondition);
            if (!empty($reviewDataResponse) && !empty($overallRateingResponse)) {
                echo "<script>window.location.replace('../courseDetailView.php?view=" . $_POST['course_id'] . "&alert_type=" . $alert_type . "&alert_message=" . $alert_message . "');</script>";
            } else {
                echo "<script>window.location.replace('../courseDetailView.php?view=" . $_POST['course_id'] . "&alert_type=" . $alert_type . "&alert_message=" . $alert_message . "');</script>";
            }
        }
    }

    // User Review Edit Ajax
    if ($module == "editReviewAjax" && $moduleMethod == "course_review") {
        if ($_REQUEST['review_id'] != "") {
            $checkReviewCondition['user_id'] = $_SESSION["userId"];
            $checkReviewCondition['id'] = $_REQUEST['review_id'];
            $checkReviewResponse = getData('course_review', $checkReviewCondition);
            $checkReviewResponse = $checkReviewResponse->fetch_assoc();
            if (!empty($checkReviewResponse)) {
                echo '<form action="include/UserSubmitData.php" method="POST" class="xs-form">
                <input type="hidden" name="module" value="course_reviewAdd">
                <input type="hidden" name="moduleMethod" value="course_review">
                <input type="hidden" name="edit" value="' . $_REQUEST['review_id'] . '">
                <input type="hidden" name="course_id" value="' . $checkReviewResponse['course_id'] . '">
                <div class="form-group xs-form-anim active">
                    <label class="input-label" for="rating">Rating</label>
                    <input type="number" id="rating" name="rating" class="form-control" value="' . $checkReviewResponse['rating'] . '" min="1" max="5" required>
                </div>
                <div class="form-group xs-form-anim active">
                    <label class="input-label" for="title">Title</label>
                    <input type="text" id="title" name="title" class="form-control" value="' . $checkReviewResponse['title'] . '">
                </div>
                <div class="form-group xs-form-anim active xs-message-box">
                    <label class="input-label input-label-textarea" for="description">Description</label>
                    <textarea id="description" name="description" class="form-control">' . $checkReviewResponse['description'] . '</textarea>
                </div>
                <div class="form-group mt-30">
                    <button type="submit" id="reviewSub" name="reviewSub" style="border-radius: 0px; font-size: 17px;" class="pr-3 pl-3 pt-2 pb-2 btn btn-primary">Submit Now</button>
                </div>
            </form>
            <hr>';
            }
        }
    }

    // User Course Search
    if ($module == "courseSearch" && $moduleMethod == "course") {
        if (isset($_POST['searchVal'])) {
            // $_POST['searchVal']
            $sql = "SELECT * FROM course WHERE title LIKE '%" . $_POST['searchVal'] . "%'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                echo "<ul>";
                while ($row = $result->fetch_assoc()) {
                    echo "
                    <li>
                        <a href='courseDetailView.php?view=" . $row['id'] . "'>
                            " . $row['title'] . "
                        </a>
                    </li>";
                }
                echo "</ul>";
            } else {
                echo "<ul>";
                while ($row = $result->fetch_assoc()) {
                    echo "
                    <li>
                        <a href='javascript:void(0)'>
                            No Data Found...!
                        </a>
                    </li>";
                }
                echo "</ul>";
            }
        }
    }

    // Course Content Progress Insert
    if ($module == "videoWatched" && $moduleMethod == "course_progress") {
        if (isset($_POST['course_position']) && isset($_POST['course_id']) && isset($_POST['content_id']) && isset($_POST['chapter_id'])) {
            $Condition['user_id'] = $_SESSION["userId"];
            $Condition['course_id']  = $_POST['course_id'];
            $Condition['chapter_id']  = $_POST['chapter_id'];
            $Condition['content_id']  = $_POST['content_id'];
            $response = getData($moduleMethod, $Condition);
            $response = $response->fetch_assoc();
            if (empty($response)) {
                $uniqid = uniqid();
                $course_progress = array(
                    'id' => $uniqid,
                    'user_id' => $_SESSION["userId"],
                    'course_id' => $_REQUEST['course_id'],
                    'chapter_id' => $_REQUEST['chapter_id'],
                    'content_id' => $_REQUEST['content_id'],
                    'date_entered' => date("Y-m-d H:i:s"),
                    'date_modified' => date("Y-m-d H:i:s"),
                    'modified_user_id' => $_SESSION["userId"],
                    'created_by' => $_SESSION["userId"],
                    'deleted' => 0,
                );
                $courseProgressResponse = insertData($moduleMethod, $course_progress);
                if (!empty($courseProgressResponse)) {
                    $contentPos = $_POST['course_position'];
                    $contentPos++;

                    $courseContentCondition['course_id']  = $_POST['course_id'];
                    $courseContentCondition['chapter_id']  = $_POST['chapter_id'];
                    $courseContentCondition['position_order']  = $contentPos;
                    $courseContent = getData('course_content', $courseContentCondition);
                    $courseContent = $courseContent->fetch_assoc();
                    if (!empty($courseContent)) {
                        echo "courseContentView.php?view=" . $courseContent['course_id'] . "&course_content_id=" . $courseContent['id'];
                    } else {
                        $courseChapterCondition['id'] = $_POST['chapter_id'];
                        $courseChapter = getData('course_chapter', $courseChapterCondition);
                        $courseChapter = $courseChapter->fetch_assoc();
                        if (!empty($courseChapter)) {
                            $chapterPosition = $courseChapter['position_order'];
                            $chapterPosition++;

                            $courseChapternewCondition['course_id']  = $_POST['course_id'];
                            $courseChapternewCondition['position_order']  = $chapterPosition;
                            $coursenewChapter = getData('course_chapter', $courseChapternewCondition);
                            $coursenewChapter = $coursenewChapter->fetch_assoc();
                            if ($coursenewChapter) {
                                $newChapterConCondition['course_id']  = $_POST['course_id'];
                                $newChapterConCondition['chapter_id']  = $coursenewChapter['id'];
                                $newChapterConCondition['position_order']  = 1;
                                $newChapterCon = getData('course_content', $newChapterConCondition);
                                $newChapterCon = $newChapterCon->fetch_assoc();
                                echo "courseContentView.php?view=" . $newChapterCon['course_id'] . "&course_content_id=" . $newChapterCon['id'];
                            }
                        }
                    }
                }
            } else {
                $contentPos = $_POST['course_position'];
                $contentPos++;

                $courseContentCondition['course_id']  = $_POST['course_id'];
                $courseContentCondition['chapter_id']  = $_POST['chapter_id'];
                $courseContentCondition['position_order']  = $contentPos;
                $courseContent = getData('course_content', $courseContentCondition);
                $courseContent = $courseContent->fetch_assoc();
                if (!empty($courseContent)) {
                    echo "courseContentView.php?view=" . $courseContent['course_id'] . "&course_content_id=" . $courseContent['id'];
                } else {
                    $courseChapterCondition['id']  = $_POST['chapter_id'];
                    $courseChapter = getData('course_chapter', $courseChapterCondition);
                    $courseChapter = $courseChapter->fetch_assoc();
                    if (!empty($courseChapter)) {
                        $chapterPosition = $courseChapter['position_order'];
                        $chapterPosition++;

                        $courseChapternewCondition['course_id'] = $_POST['course_id'];
                        $courseChapternewCondition['position_order'] = $chapterPosition;
                        $coursenewChapter = getData('course_chapter', $courseChapternewCondition);
                        $coursenewChapter = $coursenewChapter->fetch_assoc();
                        if (!empty($coursenewChapter)) {
                            $newChapterConCondition['course_id'] = $_POST['course_id'];
                            $newChapterConCondition['chapter_id'] = $coursenewChapter['id'];
                            $newChapterConCondition['position_order']  = 1;
                            $newChapterCon = getData('course_content', $newChapterConCondition);
                            $newChapterCon = $newChapterCon->fetch_assoc();
                            echo "courseContentView.php?view=" . $newChapterCon['course_id'] . "&course_content_id=" . $newChapterCon['id'];
                        }
                    }
                }
            }
        }
    }

    // Course Content Progress Insert
    if ($module == "documentWatched" && $moduleMethod == "course_progress") {
        if (isset($_POST['Doc_course_position']) && isset($_POST['Doc_course_id']) && isset($_POST['Doc_content_id']) && isset($_POST['Doc_chapter_id'])) {
            $Condition['user_id'] = $_SESSION["userId"];
            $Condition['course_id']  = $_POST['Doc_course_id'];
            $Condition['chapter_id']  = $_POST['Doc_chapter_id'];
            $Condition['content_id']  = $_POST['Doc_content_id'];
            $response = getData($moduleMethod, $Condition);
            $response = $response->fetch_assoc();
            if (empty($response)) {
                $uniqid = uniqid();
                $course_progress = array(
                    'id' => $uniqid,
                    'user_id' => $_SESSION["userId"],
                    'course_id' => $_REQUEST['Doc_course_id'],
                    'chapter_id' => $_REQUEST['Doc_chapter_id'],
                    'content_id' => $_REQUEST['Doc_content_id'],
                    'date_entered' => date("Y-m-d H:i:s"),
                    'date_modified' => date("Y-m-d H:i:s"),
                    'modified_user_id' => $_SESSION["userId"],
                    'created_by' => $_SESSION["userId"],
                    'deleted' => 0,
                );
                $courseProgressResponse = insertData($moduleMethod, $course_progress);
                if (!empty($courseProgressResponse)) {
                    echo "course_added_in_progress";
                }
            } else {
                echo "course_notadded_in_progress";
            }
        }
    }

    // Course Content Checkbox
    if ($module == "userProgress_checkbox" && $moduleMethod == "course_progress") {
        if (isset($_POST['course_id']) && isset($_POST['content_id']) && isset($_POST['chapter_id']) && isset($_POST['add_delete'])) {
            if ($_POST['add_delete'] == "true") {
                $uniqid = uniqid();
                $course_progress = array(
                    'id' => $uniqid,
                    'user_id' => $_SESSION["userId"],
                    'course_id' => $_REQUEST['course_id'],
                    'chapter_id' => $_REQUEST['chapter_id'],
                    'content_id' => $_REQUEST['content_id'],
                    'date_entered' => date("Y-m-d H:i:s"),
                    'date_modified' => date("Y-m-d H:i:s"),
                    'modified_user_id' => $_SESSION["userId"],
                    'created_by' => $_SESSION["userId"],
                    'deleted' => 0,
                );
                $courseProgressResponse = insertData($moduleMethod, $course_progress);
                if (!empty($courseProgressResponse)) {
                    echo "course_added_in_progress";
                }
            }
            if ($_POST['add_delete'] == "false") {
                $deleteProgressCondition['content_id'] = $_REQUEST['content_id'];
                $deleteProgressCondition['user_id'] = $_SESSION["userId"];
                $DeleteCartResponse = deleteData($moduleMethod, $deleteProgressCondition);
                if (!empty($DeleteCartResponse)) {
                    echo "course_deleted_in_progress";
                }
            }
        }
    }

    // User Monthly Report
    if ($module == "user_monthly_report" && $moduleMethod == "user_report") {
        if (isset($_POST['edituserMonthReport'])) {
            if (!empty($_POST['editReport'])) {
                $user_report = array(
                    'weight' => $_POST['weightEdit'],
                    'date_modified' => date("Y-m-d H:i:s"),
                    'modified_user_id' => $_SESSION["userId"],
                    'deleted' => 0,
                );
                $Condition['id'] = $_POST['editReport'];
                $Condition['user_id'] = $_SESSION["userId"];
                $user_reportResponse = updateData($moduleMethod, $user_report, $Condition);
                if (!empty($user_reportResponse)) {
                    $alert_type = "alert-success";
                    $alert_message = "Your monthly report is updated.";
                    echo "<script>window.location.replace('../userDashboard.php?dasboard=myprogress&alert_type=" . $alert_type . "&alert_message=" . $alert_message . "');</script>";
                } else {
                    $alert_type = "alert-danger";
                    $alert_message = "Something want wrong <span>please try again!</span>";
                    echo "<script>window.location.replace('../userDashboard.php?dasboard=myprogress&alert_type=" . $alert_type . "&alert_message=" . $alert_message . "');</script>";
                }
            }
        }
        if (isset($_POST['userMonthReport'])) {
            $user_report = array(
                'id' => uniqid(),
                'user_id' => $_SESSION["userId"],
                'weight' => $_POST['weight'],
                'reg_month' => date("m"),
                'reg_year' => date("Y"),
                'date_entered' => date("Y-m-d H:i:s"),
                'date_modified' => date("Y-m-d H:i:s"),
                'modified_user_id' => $_SESSION["userId"],
                'created_by' => $_SESSION["userId"],
                'deleted' => 0,
            );
            $user_reportResponse = insertData($moduleMethod, $user_report);
            if (!empty($user_reportResponse)) {
                $alert_type = "alert-success";
                $alert_message = "Your monthly report is submited.";
                echo "<script>window.location.replace('../index.php?alert_type=" . $alert_type . "&alert_message=" . $alert_message . "');</script>";
            } else {
                $alert_type = "alert-danger";
                $alert_message = "Something want wrong <span>please try again!</span>";
                echo "<script>window.location.replace('../index.php?alert_type=" . $alert_type . "&alert_message=" . $alert_message . "');</script>";
            }
        }
    }
}
