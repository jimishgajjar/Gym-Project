<?php session_start();
include('header.php'); ?>

<body class="">

    <!-- [ auth-signin ] start -->
    <div class="auth-wrapper">
        <div class="auth-content">
            <div class="card">
                <div class="row align-items-center text-center">
                    <div class="col-md-12">
                        <div class="card-body">
                            <img src="assets/images/logo-dark.png" alt="" class="img-fluid mb-4">
                            <h4 class="mb-3 f-w-400">Signin</h4>
                            <form class="my-4" action="include/AdminSubmitData.php" method="POST">
                                <?php
                                if (!empty($_REQUEST['alert_type']) && !empty($_REQUEST['alert_message'])) { ?>
                                    <div class="alert alert <?php echo $_REQUEST['alert_type'] ?> alert-dismissible fade show text-left" role="alert">
                                        <?php echo $_REQUEST['alert_message']; ?>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    </div>
                                    <script>
                                        window.setTimeout(function() {
                                            $(".alert").fadeTo(500, 0).slideUp(500, function() {
                                                $(this).remove();
                                            });
                                        }, 4000);
                                    </script>
                                <?php } ?>

                                <input type="hidden" name="module" value="adminLogin">
                                <input type="hidden" name="moduleMethod" value="admin">
                                <div class="form-group mb-3">
                                    <label class="floating-label" for="adminEmail">Email address</label>
                                    <input type="text" class="form-control" id="adminEmail" name="adminEmail" placeholder="">
                                </div>
                                <div class="form-group mb-4">
                                    <label class="floating-label" for="adminPassword">Password</label>
                                    <input type="password" class="form-control" name="adminPassword" id="adminPassword" placeholder="">
                                </div>
                                <button type="submit" class="btn btn-block btn-primary mb-4">Signin</button>
                            </form>
                            <p class="mb-2 text-muted">Forgot password? <a href="auth-reset-password.html" class="f-w-400">Reset</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- [ auth-signin ] end -->

    <!-- Required Js -->
    <?php include('footer.php'); ?>

</body>

</html>