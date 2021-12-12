<?php
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
                        <input type="hidden" name="module" value="userResetPass">
                        <input type="hidden" name="moduleMethod" value="user">
                        <input type="hidden" name="email" value="<?php echo $_REQUEST['email']; ?>">
                        <input type="hidden" name="reset_key" value="<?php echo $_REQUEST['reset_key']; ?>">
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" title="Use 8 or more characters with a mix of letters, numbers & symbols" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" title="Use 8 or more characters with a mix of letters, numbers & symbols" required>
                        </div>
                        <div class="mb-3" id="div-message">
                            <h6 id="message"></h6>
                        </div>
                        <button type="submit" name="userChangePasswordSub" id="userChangePasswordSub" class="btn btn-primary btn-lg">Change Password</button>
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
    <script>
        $(document).ready(function() {
            $("#div-message").css("display", "none");
        });

        $(document).ready(function() {
            $('#password, #confirm_password').on('keyup', function() {
                if ($('#password').val() == "" || $('#confirm_password').val() == "") {
                    $("#div-message").css("display", "block");
                    $('#message').html('Pasword can not be empty').css('color', 'red');
                } else if ($('#password').val() == $('#confirm_password').val()) {
                    $("#div-message").css("display", "block");
                    $('#message').html('Password matching').css('color', 'green');
                } else {
                    $("#div-message").css("display", "block");
                    $('#message').html('Password not matching').css('color', 'red');
                }
            });

            $('#userChangePasswordSub').on('click', function() {
                if ($('#password').val() == "" || $('#confirm_password').val() == "") {
                    $("#divpass").css("margin-bottom", "0px");
                    $("#div-message").css("display", "block");
                    $('#message').html('Pasword can not be empty').css('color', 'red');
                    return false;
                } else if ($('#password').val() == $('#confirm_password').val()) {
                    $("#divpass").css("margin-bottom", "0px");
                    $("#div-message").css("display", "block");
                    $('#message').html('Password matching').css('color', 'green');
                    $('#changePass').submit();
                } else {
                    $("#divpass").css("margin-bottom", "0px");
                    $("#div-message").css("display", "block");
                    $('#message').html('Password not matching').css('color', 'red');
                    return false;
                }
            });
        });
    </script>
</body>

</html>