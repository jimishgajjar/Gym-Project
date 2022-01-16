<?php
date_default_timezone_set("Asia/Kolkata");
include('checkSession.php');
include('header.php');
?>

<body>
    <?php include('menu.php'); ?>


    <section class="user-dashboard">
        <div class="container pt-80">
            <div class="row justify-content-md-center pt-5">
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

                    <div class="dashboard-panel">
                        <div>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <h4 class="title">User Profile</h4>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="text-center">
                                        <img src="assets/images/user-profile/default_pic.png" alt="" width="15z0" style="border-radius: 50%;" />
                                        <input type="file" class="form-control mt-4" id="full_name" name="full_name" required>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6>Basic Details</h6>
                                    <form action="include/UserSubmitData.php" method="POST">
                                        <input type="hidden" name="module" value="userDetailUpdate">
                                        <input type="hidden" name="moduleMethod" value="user">
                                        <div class="form-group xs-form-anim pt-1">
                                            <label class="input-label" for="full_name">Full Name</label>
                                            <input type="text" id="full_name" name="full_name" value="<?php echo $userDataResponse['full_name']; ?>" class="form-control" required>
                                        </div>
                                        <div class="form-group mt-30">
                                            <button type="submit" name="userDetailUpdateSub" class="pr-4 pl-4 btn btn-primary">Save</button>
                                        </div>
                                    </form>

                                    <h6>Change Password</h6>
                                    <form action="include/UserSubmitData.php" method="POST">
                                        <input type="hidden" name="module" value="userChangePass">
                                        <input type="hidden" name="moduleMethod" value="user">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group xs-form-anim pt-1">
                                                    <label class="input-label" for="cureent_pwd">Cureent Password</label>
                                                    <input type="password" id="cureent_pwd" name="cureent_pwd" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group xs-form-anim">
                                                    <label class="input-label" for="password">New Password</label>
                                                    <input type="password" id="password" name="password" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group xs-form-anim">
                                                    <label class="input-label" for="confirm_password">Confirm New Password</label>
                                                    <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mt-3" id="div-message">
                                                <h6 id="message"></h6>
                                            </div>
                                        </div>
                                        <div class="form-group mt-30">
                                            <button type="submit" id="userChangePasswordSub" name="userChangePasswordSub" class="btn btn-primary">Change Password</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include('footer.php'); ?>
</body>

</html>