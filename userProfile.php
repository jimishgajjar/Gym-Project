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
                <div class="col-md-9">
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

                    <div class="d-flex flex-wrap  justify-content-center pb-4">
                        <a href="#" name="" id="userprofile" class="btn pr-btn pr-btn-active m-2">Profile</a>
                        <a href="#" name="" id="changepassword" class="btn pr-btn m-2">Change Password</a>
                        <a href="#" name="" id="wishlist" class="btn pr-btn m-2">Wishlist</a>
                        <a href="#" name="" id="cart" class="btn pr-btn m-2">Cart</a>
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
                                                <img src="assets/userprofile/<?php echo $userDataResponse['profile_pic']; ?>" id="user_pic" alt="user_pic" width="150" height="150" style="border-radius: 50%;" />
                                            </div>
                                            <div class="col-md-12 d-flex flex-wrap justify-content-center mt-3" id="upload_div">
                                                <a href="#" name="upload_pic" id="upload_pic" class="btn btn-primary m-1">Upload Photo</a>
                                                <a href="#" name="remove_pic" id="remove_pic" class="btn btn-primary m-1" style="display: none;">Remove Photo</a>
                                            </div>
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
                                    <h4 class="title">Chnage Password</h4>
                                </div>
                            </div>
                            <hr>
                            <form action="include/UserSubmitData.php" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="row justify-content-md-center">
                                            <div class="col-md-12 text-center">
                                                <img src="assets/userprofile/<?php echo $userDataResponse['profile_pic']; ?>" id="user_pic" alt="user_pic" width="150" height="150" style="border-radius: 50%;" />
                                            </div>
                                            <div class="col-md-12 d-flex flex-wrap justify-content-center mt-3" id="upload_div">
                                                <a href="#" name="upload_pic" id="upload_pic" class="btn btn-primary m-1">Upload Photo</a>
                                                <a href="#" name="remove_pic" id="remove_pic" class="btn btn-primary m-1" style="display: none;">Remove Photo</a>
                                            </div>
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

                        <div class="wishlist">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <h4 class="title">User Wishlist</h4>
                                </div>
                            </div>
                            <hr>
                            <form action="include/UserSubmitData.php" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="row justify-content-md-center">
                                            <div class="col-md-12 text-center">
                                                <img src="assets/userprofile/<?php echo $userDataResponse['profile_pic']; ?>" id="user_pic" alt="user_pic" width="150" height="150" style="border-radius: 50%;" />
                                            </div>
                                            <div class="col-md-12 d-flex flex-wrap justify-content-center mt-3" id="upload_div">
                                                <a href="#" name="upload_pic" id="upload_pic" class="btn btn-primary m-1">Upload Photo</a>
                                                <a href="#" name="remove_pic" id="remove_pic" class="btn btn-primary m-1" style="display: none;">Remove Photo</a>
                                            </div>
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

                        <div class="cart">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <h4 class="title">User Cart</h4>
                                </div>
                            </div>
                            <hr>
                            <form action="include/UserSubmitData.php" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="row justify-content-md-center">
                                            <div class="col-md-12 text-center">
                                                <img src="assets/userprofile/<?php echo $userDataResponse['profile_pic']; ?>" id="user_pic" alt="user_pic" width="150" height="150" style="border-radius: 50%;" />
                                            </div>
                                            <div class="col-md-12 d-flex flex-wrap justify-content-center mt-3" id="upload_div">
                                                <a href="#" name="upload_pic" id="upload_pic" class="btn btn-primary m-1">Upload Photo</a>
                                                <a href="#" name="remove_pic" id="remove_pic" class="btn btn-primary m-1" style="display: none;">Remove Photo</a>
                                            </div>
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
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include('footer.php'); ?>
    <script>
        $(".changepassword").hide();
        $(".wishlist").hide();
        $(".cart").hide();

        $("#userprofile").click(function() {
            $(".userprofile").show();
            $(".changepassword").hide();
            $(".wishlist").hide();
            $(".cart").hide();
        });

        $("#changepassword").click(function() {
            $(".changepassword").show();
            $(".userprofile").hide();
            $(".wishlist").hide();
            $(".cart").hide();
        });

        $("#wishlist").click(function() {
            $(".wishlist").show();
            $(".userprofile").hide();
            $(".changepassword").hide();
            $(".cart").hide();
        });

        $("#cart").click(function() {
            $(".cart").show();
            $(".userprofile").hide();
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
            }
        });

        $("#remove_pic").click(function() {
            $('#user_pic').attr('src', "assets/userprofile/<?php echo $userDataResponse['profile_pic']; ?>");
            $("#profile_pic").val("");
            $("#remove_pic").css('display', 'none');
        });
    </script>
</body>

</html>