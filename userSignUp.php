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
                        <input type="hidden" name="module" value="userSignup">
                        <input type="hidden" name="moduleMethod" value="user">
                        <div class="mb-2">
                            <label for="full_name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Full Name" required>
                        </div>
                        <div class="mb-2">
                            <label for="mobile_no" class="form-label">Mobile No</label>
                            <input type="text" class="form-control" id="mobile_no" name="mobile_no" placeholder="Mobile no" pattern="[0-9]{10}" title="Enter 10 digit mobile number." maxlength="10" minlength="10" required>
                        </div>
                        <div class="mb-2">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                        </div>
                        <div class="mb-2 row">
                            <div class="col-md-6">
                                <label for="height" class="form-label">Height</label>
                                <input type="number" class="form-control" id="height" name="height" placeholder="Height" step="0.01" minlength="1" required>
                            </div>
                            <div class="col-md-6">
                                <label for="weight" class="form-label">Weight</label>
                                <input type="number" class="form-control" id="weight" name="weight" placeholder="weight" step="0.01" minlength="1" required>
                            </div>
                        </div>
                        <div class="mb-2">
                            <label for="gender" class="form-label">Gender</label>
                            <select class="form-control" id="gender" name="gender">
                                <option selected disabled>Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label for="age" class="form-label">Age</label>
                            <input type="number" class="form-control" id="age" name="age" placeholder="Age" minlength="1" required>
                        </div>
                        <div class="mb-2">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                        </div>
                        <button type="submit" class="mt-2 btn btn-primary btn-lg">Sign Up</button>
                    </form>
                    <hr>
                    <div class="mb-3 text-center">
                        <div class="mt-10">
                            <span>
                                Already have an account? </span><a class="sign-link" href="userLogin.php">
                                <b>Log In</b>
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