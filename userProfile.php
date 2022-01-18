<?php
date_default_timezone_set("Asia/Kolkata");
include('checkSession.php');
include('header.php');
?>
<style>
    #profile_pic {
        display: none;
    }
</style>

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
                            <style>
                                .upload-pic {
                                    display: flex;
                                    flex-wrap: wrap;
                                }
                            </style>
                            <div class="row justify-content-md-center">
                                <div class="col-md-5">
                                    <form action="include/UserSubmitData.php" method="POST" class="xs-form">
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <img src="assets/images/user-profile/default_pic.png" alt="" width="150" style="border-radius: 50%;" />
                                            </div>
                                            <div class="col-md-12 text-center pt-3">
                                                <button type="submit" name="upload_pic" id="upload_pic" class="pr-4 pl-4 btn btn-primary">Upload Pic</button>
                                                <!-- <button type="submit" name="upload_pic" class="pr-4 pl-4 m-1 btn btn-primary">Upload</button> -->
                                                <input type="file" class="mt-4" id="profile_pic" name="profile_pic" required>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-7">
                                    <form action="include/UserSubmitData.php" method="POST" class="xs-form">
                                        <input type="hidden" name="module" value="userDetailUpdate">
                                        <input type="hidden" name="moduleMethod" value="user">
                                        <div class="form-group xs-form-anim active">
                                            <label class="input-label" for="full_name">Full Name</label>
                                            <input type="text" id="full_name" name="full_name" value="<?php echo $userDataResponse['full_name']; ?>" class="form-control" required>
                                        </div>
                                        <div class="form-group xs-form-anim active pt-1">
                                            <label class="input-label" for="full_name">Full Name</label>
                                            <input type="text" id="full_name" name="full_name" value="<?php echo $userDataResponse['full_name']; ?>" class="form-control" required>
                                        </div>
                                        <div class="form-group text-center mt-30">
                                            <button type="submit" name="userDetailUpdateSub" class="pr-4 pl-4 btn btn-primary">Save</button>
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
    <script>
        $("#upload_pic").click(function() {
            $("#profile_pic").click();
        });
    </script>
</body>

</html>