<?php
session_start();
include('header.php');

if (isset($_REQUEST['withoutLogin']) && $_REQUEST['withoutLogin'] == "withoutLogin") {
    $_SESSION["withoutLogin"] = $_REQUEST['withoutLogin'];
}

if (isset($_REQUEST['withoutLogin']) && $_REQUEST['withoutLogin'] == "login") {
    $_SESSION["withoutLogin"] = $_REQUEST['withoutLogin'];
}
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
                        <?php if (isset($_REQUEST['checkbuy']) && !empty($_REQUEST['checkbuy']) && $_REQUEST['checkbuy'] == "buynow") { ?>
                            <input type="hidden" name="checkbuy" value="<?php echo $_REQUEST['checkbuy']; ?>">
                            <input type="hidden" name="buynow" value="<?php echo $_REQUEST['buynow']; ?>">
                        <?php } ?>
                        <?php if (isset($_REQUEST['checkbuy']) && !empty($_REQUEST['checkbuy']) && $_REQUEST['checkbuy'] == "cart") { ?>
                            <input type="hidden" name="checkbuy" value="<?php echo $_REQUEST['checkbuy']; ?>">
                        <?php } ?>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                        </div>
                        <button type="submit" name="userLoginSub" class="btn btn-primary btn-lg btn-100">Log In</button>
                    </form>
                    <hr>
                    <div class="mb-3 text-center">
                        <div>
                            <span>or </span><a href="userForgotPassword.php" class="forgot-password-link">Forgot
                                Password</a>
                        </div>
                        <div class="mt-10">
                            <?php if (isset($_REQUEST['checkbuy']) && !empty($_REQUEST['checkbuy']) && $_REQUEST['checkbuy'] == "buynow") { ?>
                                <span>Don't have an account? </span><a class="sign-link" href="userSignUp.php?withoutLogin=<?php echo $_REQUEST['withoutLogin']; ?>&checkbuy=<?php echo $_REQUEST['checkbuy']; ?>&buynow=<?php echo $_REQUEST['buynow']; ?>">
                                    <b>Sign Up</b>
                                </a>
                            <?php } ?>
                            <?php if (isset($_REQUEST['checkbuy']) && !empty($_REQUEST['checkbuy']) && $_REQUEST['checkbuy'] == "cart") { ?>
                                <span>Don't have an account? </span><a class="sign-link" href="userSignUp.php?withoutLogin=<?php echo $_REQUEST['withoutLogin']; ?>&checkbuy=<?php echo $_REQUEST['checkbuy']; ?>">
                                    <b>Sign Up</b>
                                </a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include('footer.php'); ?>

</body>

</html>