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
                            <div class="row">
                                <div class="col-md-5">
                                    <form action="include/UserSubmitData.php" method="POST" class="xs-form">
                                        <div class="row justify-content-md-center">
                                            <div class="col-md-12 text-center">
                                                <img src="assets/images/user-profile/<?php echo $userDataResponse['profile_pic']; ?>" alt="" width="150" style="border-radius: 50%;" />
                                            </div>
                                            <div class="col-md-12 d-flex justify-content-center mt-3">
                                                <button align="center" type="submit" name="upload_pic" id="upload_pic" class="btn btn-primary m-1">Upload Photo</button>
                                                <button align="center" type="submit" name="remove_pic" id="remove_pic" class="btn btn-primary m-1">Remove Photo</button>
                                            </div>
                                            <input type="file" class="mt-4" id="profile_pic" name="profile_pic" required>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-7">
                                    <form action="include/UserSubmitData.php" method="POST" class="xs-form">
                                        <input type="hidden" name="module" value="userDetailUpdate">
                                        <input type="hidden" name="moduleMethod" value="user">
                                        <div class="row mb-4">
                                            <div class="col-md-3">
                                                <b>Email:</b>
                                            </div>
                                            <div class="col-md-8">
                                                <?php echo $userDataResponse['email']; ?>
                                            </div>
                                        </div>
                                        <div class="form-group xs-form-anim active">
                                            <label class="input-label" for="full_name">Full Name</label>
                                            <input type="text" id="full_name" class="form-control" value="<?php echo $userDataResponse['full_name']; ?>">
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

        $("#profile_pic").change(function() {
            var file = document.getElementById("profile_pic");
            if (file.files.length != 0) {
                alert("Some file is selected");
                document.getElementById("upload_pic").style.display = "none";
                document.getElementById("remove_pic").style.display = "block";
            } else {
                alert("No files selected");
                document.getElementById("upload_pic").style.display = "block";
                document.getElementById("remove_pic").style.display = "none";
            }
        });
    </script>
</body>

</html>