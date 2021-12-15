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
                        <input type="hidden" name="module" value="userForgotPassword">
                        <input type="hidden" name="moduleMethod" value="user">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                        </div>
                        <button type="submit" name="userForgotPasswordSub" class="btn btn-primary btn-lg">Reset Password</button>
                    </form>
                    <hr>
                    <div class="mb-3 text-center">
                        <div>
                            <span>or </span><a href="userLogin.php" class="forgot-password-link">Log In</a>
                        </div>
                        <div class="mt-10">
                            <span>Don't have an account? </span><a class="sign-link" href="userSignUp.php">
                                <b>Sign Up</b>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include('footer.php'); ?>

</body>

</html>