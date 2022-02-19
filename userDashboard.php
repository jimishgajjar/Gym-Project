<?php
date_default_timezone_set("Asia/Kolkata");
include('checkSession.php');
include('header.php');
?>
<style>
    #profile_pic {
        display: none;
    }

    .upload-pic {
        display: flex;
        flex-wrap: wrap;
    }
</style>

<body>
    <?php include('menu.php'); ?>


    <section class="user-dashboard">
        <div class="container pt-80">
            <div class="row justify-content-md-center pt-4">
                <div class="col-md-12">
                    <?php
                    if (!empty($_REQUEST['alert_type']) && !empty($_REQUEST['alert_message'])) { ?>
                        <div class="form-group">
                            <div class="alert <?php echo $_REQUEST['alert_type'] ?> alert-dismissible fade show" role="alert">
                                <?php echo $_REQUEST['alert_message']; ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                        <script>
                            window.setTimeout(function() {
                                $(".alert").fadeTo(500, 0).slideUp(500, function() {
                                    $(this).remove();
                                });
                            }, 4000);
                        </script>
                    <?php } ?>

                    <div id="dashboardMenu" class="d-flex flex-wrap justify-content-center pb-4">
                        <a href="javascript:void(0);" id="userprofile" class="btn pr-btn m-2">Profile</a>
                        <a href="javascript:void(0);" id="changepassword" class="btn pr-btn m-2">Change Password</a>
                        <a href="javascript:void(0);" id="mycourse" class="btn pr-btn m-2">My Course</a>
                        <a href="javascript:void(0);" id="wishlist" class="btn pr-btn m-2">Wishlist</a>
                        <a href="javascript:void(0);" id="cartlist" class="btn pr-btn m-2">Cart</a>
                    </div>

                    <div class="dashboard-panel">
                        <div class="userprofile">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <h4 class="title">User Profile</h4>
                                </div>
                            </div>
                            <hr>
                            <form action="include/UserSubmitData.php" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="row justify-content-md-center">
                                            <div class="col-md-12 text-center">
                                                <img src="<?php echo $userProfilePath . $userDataResponse['profile_pic']; ?>" id="user_pic" alt="user_pic" width="150" height="150" style="border-radius: 50%;" />
                                            </div>
                                            <div class="col-md-12 d-flex flex-wrap justify-content-center mt-3" id="upload_div">
                                                <a href="#" name="upload_pic" id="upload_pic" class="btn btn-primary m-1">Upload Photo</a>
                                                <a href="#" name="remove_pic" id="remove_pic" class="btn btn-primary m-1" style="display: none;">Remove Photo</a>
                                            </div>
                                            <h6 class="mt-2" style="color: red;" id="profile_pic_error"></h6>
                                            <input type="file" class="mt-4" id="profile_pic" name="profile_pic">
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="hidden" name="module" value="userDetailUpdate">
                                        <input type="hidden" name="moduleMethod" value="user">
                                        <div class="row">
                                            <div class="col-md-12 form-group xs-form-anim active">
                                                <label class="input-label" for="email">Email</label>
                                                <input type="text" id="email" name="email" class="form-control" value="<?php echo $userDataResponse['email']; ?>" disabled required>
                                            </div>
                                            <div class="col-md-6 form-group xs-form-anim active">
                                                <label class="input-label" for="full_name">Full Name</label>
                                                <input type="text" id="full_name" name="full_name" placeholder="Full Name" class="form-control" value="<?php echo $userDataResponse['full_name']; ?>" required>
                                            </div>
                                            <div class="col-md-6 form-group xs-form-anim active">
                                                <label class="input-label" for="mobile_no">Mobile no</label>
                                                <input type="text" id="mobile_no" name="mobile_no" placeholder="Mobile No" class="form-control" value="<?php echo $userDataResponse['mobile_no']; ?>" pattern="[0-9]{10}" title="Enter 10 digit mobile number." maxlength="10" minlength="10" required>
                                            </div>
                                            <div class="col-md-4 form-group xs-form-anim active">
                                                <label class="input-label" for="height">Height</label>
                                                <input type="number" id="height" name="height" placeholder="Height" class="form-control" value="<?php echo $userDataResponse['height']; ?>" step="0.01" minlength="1" required>
                                            </div>
                                            <div class="col-md-4 form-group xs-form-anim active">
                                                <label class="input-label" for="weight">Weight</label>
                                                <input type="number" id="weight" name="weight" placeholder="Weight" class="form-control" value="<?php echo $userDataResponse['weight']; ?>" step="0.01" minlength="1" required>
                                            </div>
                                            <div class="col-md-4 form-group xs-form-anim active">
                                                <label class="input-label" for="age">Age</label>
                                                <input type="number" id="age" name="age" placeholder="Age" class="form-control" value="<?php echo $userDataResponse['age']; ?>" step="0.01" minlength="1" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group text-center">
                                            <button type="submit" name="userDetailUpdateSub" class="pr-4 pl-4 btn btn-primary">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="changepassword">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <h4 class="title">Change Password</h4>
                                </div>
                            </div>
                            <hr>
                            <form action="include/UserSubmitData.php" method="POST">
                                <input type="hidden" name="module" value="userChangePass">
                                <input type="hidden" name="moduleMethod" value="user">
                                <div class="row justify-content-md-center">
                                    <div class="col-md-8">
                                        <div class="form-group xs-form-anim pt-1">
                                            <label class="input-label" for="cureent_pwd">Cureent Password</label>
                                            <input type="password" id="cureent_pwd" name="cureent_pwd" placeholder="Cureent Password" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-md-center">
                                    <div class="col-md-4">
                                        <div class="form-group xs-form-anim">
                                            <label class="input-label" for="password">New Password</label>
                                            <input type="password" id="password" name="password" placeholder="New Password" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group xs-form-anim">
                                            <label class="input-label" for="confirm_password">Confirm New Password</label>
                                            <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm New Password" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-8" id="div-message">
                                        <h6 id="message"></h6>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group text-center">
                                            <button type="submit" id="userChangePasswordSub" name="userChangePasswordSub" class="btn btn-primary">Change Password</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="mycourse">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <h4 class="title">My Course</h4>
                                </div>
                            </div>
                            <hr>
                            <div class="mycourse-data">
                                <?php
                                $user_coursesCondition['user_id'] = $_SESSION["userId"];
                                $user_coursesData = getData('user_courses', $user_coursesCondition);
                                $total = 0;
                                $totalAll = 0;
                                if ($user_coursesData->num_rows > 0) { ?>
                                    <div class="row">
                                        <?php while ($row = $user_coursesData->fetch_assoc()) {
                                            $Condition['id'] = $row['course_id'];
                                            $response = getData('course', $Condition);
                                            $response = $response->fetch_assoc();
                                            if (!empty($response)) {
                                                $categoryCondition['id'] = $response['category_id'];
                                                $categoryResponse = getData('category', $categoryCondition);
                                                $categoryResponse = $categoryResponse->fetch_assoc();
                                        ?>
                                                <div class="col-md-3 mb-25">
                                                    <div class="course">
                                                        <a href="" class="course-link">
                                                            <img class="course-thumbline" src="assets/thumbnail/<?php echo $response['thumbnail']; ?>" alt="course1" />
                                                            <div class="course-content">
                                                                <div>
                                                                    <div class="course-category mb-1">
                                                                        <?php echo $categoryResponse['category_name']; ?>
                                                                    </div>
                                                                    <div class="course-title mb-1">
                                                                        <?php
                                                                        if (strlen($response['title']) >= 65) {
                                                                            echo substr($response['title'], 0, 65) . "...";
                                                                        } else {
                                                                            echo substr($response['title'], 0, 65);
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                    <div class="course-rating mb-1">
                                                                        <h6 class="course-rating-num">(<?php echo $response['rating']; ?>)</h6>
                                                                        <span class="stars"><?php echo $response['rating']; ?></span>
                                                                    </div>
                                                                </div>
                                                                <?php
                                                                $courseCountCondition['course_id']  = $row['course_id'];
                                                                $courseCount = getData('course_content', $courseCountCondition);
                                                                $courseCount = $courseCount->num_rows;
                                                                $coursePercentage = 100 / $courseCount;

                                                                $courseProgressCondition['user_id']  = $_SESSION["userId"];
                                                                $courseProgressCondition['course_id']  = $row['course_id'];
                                                                $courseProgress = getData('course_progress', $courseProgressCondition);
                                                                $courseProgress = $courseProgress->num_rows;
                                                                $userCoursePer = $courseProgress * $coursePercentage;
                                                                ?>
                                                                <div class="progress mt-2 mb-1">
                                                                    <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo round($userCoursePer); ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo round($userCoursePer); ?>%">
                                                                    </div>
                                                                </div>
                                                                <h6 style="font-size: 12px; font-weight: 600;"><?php echo round($userCoursePer); ?>% Complete</h6>
                                                                <a href="courseDetailView.php?view=<?php echo $response['id'] ?>" class="btn btn-primary btn-100">View Course</a>
                                                            </div>
                                                            <!-- </a> -->
                                                    </div>
                                                </div>
                                        <?php }
                                        } ?>
                                    </div>
                                <?php } else { ?>
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <h4 class="p-5">No products in your course.</h4>
                                            <a class="mb-20 btn btn-primary" href="index.php">Browse courses now</a>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="wishlist">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <h4 class="title">User Wishlist</h4>
                                </div>
                            </div>
                            <hr>
                            <div class="wishlist-data">
                                <?php
                                $WhishlistCondition['user_id'] = $_SESSION["userId"];
                                $wishlistData = getData('wishlist', $WhishlistCondition);
                                $total = 0;
                                $totalAll = 0;
                                if ($wishlistData->num_rows > 0) {
                                    while ($row = $wishlistData->fetch_assoc()) {
                                        $Condition['id'] = $row['course_id'];
                                        $response = getData('course', $Condition);
                                        $response = $response->fetch_assoc();
                                        if (!empty($response)) { ?>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="course-img">
                                                        <img src="<?php echo $thumbnailPath . $response['thumbnail']; ?>" />
                                                        <div class="course-img-overlay">
                                                        </div>
                                                        <div class="heart"><a href="include/UserSubmitData.php?moduleMethod=cart&module=moveWishToCartDash&Dashcourse_id=<?php echo $response['id']; ?>"><i class="fas fa-heart fa-lg"></i></a></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-9">
                                                    <p>
                                                        <?php
                                                        if (strlen($response['title']) >= 90) {
                                                            echo substr($response['title'], 0, 90) . "...";
                                                        } else {
                                                            echo $response['title'];
                                                        }
                                                        ?>
                                                    </p>
                                                    <div class="course-rating">
                                                        <h6 class="course-rating-num">(<?php echo $response['rating']; ?>)</h6>
                                                        <span class="stars"><?php echo $response['rating']; ?></span>
                                                    </div>
                                                    <h6 style="font-weight: 700;">
                                                        <?php
                                                        if ($response['discount'] != 0) {
                                                            $discountPrice = $response['price'] - ($response['price'] * $response['discount'] / 100);
                                                            $total += $discountPrice;
                                                            echo "₹" . $discountPrice . "<s style='color: #8c8c8c;' class='pl-2'>₹" . $response['price'] . "</s>";
                                                        } else {
                                                            echo "₹" . $response['price'];
                                                            $total += $response['price'];
                                                        }
                                                        $totalAll += $response['price'];
                                                        ?>
                                                    </h6>
                                                    <div class="d-flex bd-highlight">
                                                        <div class="pr-2 flex-fill bd-highlight"><a href="include/UserSubmitData.php?moduleMethod=cart&module=moveWishToCartDash&Dashcourse_id=<?php echo $row['course_id']; ?>">Add to cart</a></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                    <?php }
                                    }
                                } else { ?>
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <h4 class="p-5">No products in wishlist.</h4>
                                            <a class="mb-20 btn btn-primary" href="index.php">Browse courses now</a>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="cartlist">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <h4 class="title">User Cartlist</h4>
                                </div>
                            </div>
                            <hr>
                            <div class="cartlist-data">
                                <?php
                                $WhishlistCondition['user_id'] = $_SESSION["userId"];
                                $userCartData = getData('cart', $WhishlistCondition);
                                $total = 0;
                                $totalAll = 0;
                                if ($userCartData->num_rows > 0) { ?>
                                    <div class="row">
                                        <div class="col-md-9">
                                            <?php while ($row = $userCartData->fetch_assoc()) {
                                                $Condition['id'] = $row['course_id'];
                                                $response = getData('course', $Condition);
                                                $response = $response->fetch_assoc();
                                                if (!empty($response)) { ?>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="course-img">
                                                                <img src="<?php echo $thumbnailPath . $response['thumbnail']; ?>" />
                                                                <div class="course-img-overlay">
                                                                </div>
                                                                <div class="heart"><a href="#"><i class="fas fa-heart fa-lg"></i></a></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <p>
                                                                <?php
                                                                if (strlen($response['title']) >= 80) {
                                                                    echo substr($response['title'], 0, 80) . "...";
                                                                } else {
                                                                    echo $response['title'];
                                                                }
                                                                ?>
                                                            </p>
                                                            <div class="course-rating">
                                                                <h6 class="course-rating-num">(<?php echo $response['rating']; ?>)</h6>
                                                                <span class="stars"><?php echo $response['rating']; ?></span>
                                                            </div>
                                                            <h6 style="font-weight: 700;">
                                                                <?php
                                                                if ($response['discount'] != 0) {
                                                                    $discountPrice = $response['price'] - ($response['price'] * $response['discount'] / 100);
                                                                    $total += $discountPrice;
                                                                    echo "₹" . $discountPrice . "<s style='color: #8c8c8c;' class='pl-2'>₹" . $response['price'] . "</s>";
                                                                } else {
                                                                    echo "₹" . $response['price'];
                                                                    $total += $response['price'];
                                                                }
                                                                $totalAll += $response['price'];
                                                                ?>
                                                            </h6>
                                                            <div class="d-flex bd-highlight">
                                                                <div class="pr-2 flex-fill bd-highlight"><a href="include/UserSubmitData.php?moduleMethod=cart&module=deleteCartFromDash&remove=<?php echo $row['id']; ?>">Remove</a></div>
                                                                <div class="pl-2 flex-fill bd-highlight"><a href="include/UserSubmitData.php?moduleMethod=wishlist&module=moveCartToWishlistDash&course_id=<?php echo $row['course_id']; ?>">Move to Wishlist</a></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr>
                                            <?php }
                                            } ?>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="p-2" style="background-color: #ffecec; border-radius: 10px;">
                                                <div class="d-flex flex-column bd-highlight">
                                                    <h5 style="font-weight: 100;">Total</h5>
                                                    <h3 style="font-weight: 700;">
                                                        <h4 style="letter-spacing: 0.5px; font-weight: 600;">₹<?php echo $total; ?></h4>
                                                        <h5 style="letter-spacing: 0.5px; font-weight: 600; color: #8c8c8c;"><s>₹<?php echo $totalAll; ?></s></h5>
                                                    </h3>
                                                    <a href="payment.php" class="mt-3 bt-boder-0 btn btn-primary btn-100">Checkout</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <h4 class="p-5">No products in the cart.</h4>
                                            <a class="mb-20 btn btn-primary" href="index.php">Browse courses now</a>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include('footer.php'); ?>
    <script>
        <?php if ($_REQUEST['dasboard'] == "userprofile") { ?>
            $('#dashboardMenu a').removeClass("pr-btn-active");
            $('#userprofile').addClass("pr-btn-active");

            $(".userprofile").show();
            $(".changepassword").hide();
            $(".mycourse").hide();
            $(".wishlist").hide();
            $(".cartlist").hide();
        <?php } ?>

        <?php if ($_REQUEST['dasboard'] == "changepassword") { ?>
            $('#dashboardMenu a').removeClass("pr-btn-active");
            $('#changepassword').addClass("pr-btn-active");

            $(".changepassword").show();
            $(".userprofile").hide();
            $(".mycourse").hide();
            $(".wishlist").hide();
            $(".cartlist").hide();
        <?php } ?>

        <?php if ($_REQUEST['dasboard'] == "mycourse") { ?>
            $('#dashboardMenu a').removeClass("pr-btn-active");
            $('#mycourse').addClass("pr-btn-active");

            $(".mycourse").show();
            $(".userprofile").hide();
            $(".changepassword").hide();
            $(".wishlist").hide();
            $(".cartlist").hide();
        <?php } ?>

        <?php if ($_REQUEST['dasboard'] == "wishlist") { ?>
            $('#dashboardMenu a').removeClass("pr-btn-active");
            $("#wishlist").addClass("pr-btn-active");

            $(".wishlist").show();
            $(".userprofile").hide();
            $(".changepassword").hide();
            $(".mycourse").hide();
            $(".cartlist").hide();
        <?php } ?>

        <?php if ($_REQUEST['dasboard'] == "cartlist") { ?>
            $('#dashboardMenu a').removeClass("pr-btn-active");
            $("#cartlist").addClass("pr-btn-active");

            $(".cartlist").show();
            $(".userprofile").hide();
            $(".changepassword").hide();
            $(".mycourse").hide();
            $(".wishlist").hide();
        <?php } ?>

        $("#userprofile").click(function() {
            $('#dashboardMenu a').removeClass("pr-btn-active");
            $(this).addClass("pr-btn-active");

            $(".userprofile").show();
            $(".changepassword").hide();
            $(".mycourse").hide();
            $(".wishlist").hide();
            $(".cartlist").hide();
        });

        $("#changepassword").click(function() {
            $('#dashboardMenu a').removeClass("pr-btn-active");
            $(this).addClass("pr-btn-active");

            $(".changepassword").show();
            $(".userprofile").hide();
            $(".mycourse").hide();
            $(".wishlist").hide();
            $(".cartlist").hide();
        });

        $("#mycourse").click(function() {
            $('#dashboardMenu a').removeClass("pr-btn-active");
            $(this).addClass("pr-btn-active");

            $(".mycourse").show();
            $(".cartlist").hide();
            $(".userprofile").hide();
            $(".changepassword").hide();
            $(".wishlist").hide();
        });

        $("#wishlist").click(function() {
            $('#dashboardMenu a').removeClass("pr-btn-active");
            $(this).addClass("pr-btn-active");

            $(".wishlist").show();
            $(".userprofile").hide();
            $(".mycourse").hide();
            $(".changepassword").hide();
            $(".cartlist").hide();
        });

        $("#cartlist").click(function() {
            $('#dashboardMenu a').removeClass("pr-btn-active");
            $(this).addClass("pr-btn-active");

            $(".cartlist").show();
            $(".userprofile").hide();
            $(".mycourse").hide();
            $(".changepassword").hide();
            $(".wishlist").hide();
        });

        $("#upload_pic").click(function() {
            $("#profile_pic").click();
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#user_pic').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#profile_pic").change(function() {
            var file = document.getElementById("profile_pic");
            if (file.files.length != 0) {
                readURL(this);
                $("#remove_pic").css('display', 'block');
                if (this.files[0].size > 2097152) {
                    // alert("Try to upload file less than 2MB!");
                    $("#profile_pic_error").text("Try to upload file less than 2MB!");
                    $("#profile_pic").value = "";
                } else {
                    $("#profile_pic_error").text("");
                    readURL(this);
                }
            }
        });

        $("#remove_pic").click(function() {
            $('#user_pic').attr('src', "<?php echo $userProfilePath . $userDataResponse['profile_pic']; ?>");
            $("#profile_pic").val("");
            $("#remove_pic").css('display', 'none');
        });
    </script>
</body>

</html>