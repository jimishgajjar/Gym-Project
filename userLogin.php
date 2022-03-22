<?php
session_start();
include('header.php');
?>

<body>
    <?php include('menu.php'); ?>


    <section class="xs-section-padding section-login">
        <div class="container">
            <div class="d-flex justify-content-center">
                <div class="login">
                    <div class="mb-3 text-center">
                        <img src="assets/images/logo/logo-black.png" style="height: 100px;" />
                    </div>
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
                    <form action="include/UserSubmitData.php" method="POST">
                        <input type="hidden" name="module" value="userLogin">
                        <input type="hidden" name="moduleMethod" value="user">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                        </div>
                        <?php
                        if (isset($_REQUEST['from_checkout'])) {
                            if ($_REQUEST['from_checkout'] == 1) { ?>
                                <input type="hidden" class="form-control" id="from_checkout" name="from_checkout" placeholder="from_checkout" value="1" required>
                        <?php }
                        }
                        ?>
                        <?php
                        if (isset($_REQUEST['buynow']) && isset($_REQUEST['course_id'])) {
                            if ($_REQUEST['buynow'] == 1 && !empty($_REQUEST['course_id'])) { ?>
                                <input type="hidden" class="form-control" id="buynow" name="buynow" placeholder="buynow" value="1" required>
                                <input type="hidden" class="form-control" id="course_id" name="course_id" placeholder="course_id" value="<?php echo $_REQUEST['course_id']; ?>" required>
                        <?php }
                        }
                        ?>
                        <button type="submit" name="userLoginSub" class="btn btn-primary btn-lg btn-100">Log In</button>
                    </form>
                    <hr>
                    <div class="mb-3 text-center">
                        <div>
                            <span>or </span><a href="userForgotPassword.php" class="forgot-password-link">Forgot
                                Password</a>
                        </div>
                        <div class="mt-10">
                            <?php
                            if (isset($_REQUEST['from_checkout'])) {
                                if ($_REQUEST['from_checkout'] == 1) { ?>
                                    <span>Don't have an account? </span><a class="sign-link" href="userSignUp.php?from_checkout=1">
                                        <b>Sign Up</b>
                                    </a>
                                <?php }
                            } elseif (isset($_REQUEST['buynow']) && isset($_REQUEST['course_id'])) {
                                if ($_REQUEST['buynow'] == 1 && !empty($_REQUEST['course_id'])) { ?>
                                    <span>Don't have an account? </span><a class="sign-link" href="userSignUp.php?buynow=1&course_id=<?php echo $_REQUEST['course_id']; ?>">
                                        <b>Sign Up</b>
                                    </a>
                                <?php }
                            } else { ?>
                                <span>Don't have an account? </span><a class="sign-link" href="userSignUp.php">
                                    <b>Sign Up</b>
                                </a>
                            <?php }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include('footer.php'); ?>

</body>

</html>