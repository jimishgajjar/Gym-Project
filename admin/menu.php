<!-- [ Pre-loader ] start -->
<div class="loader-bg">
    <div class="loader-track">
        <div class="loader-fill"></div>
    </div>
</div>
<!-- [ Pre-loader ] End -->

<?php if (!empty($_REQUEST['alert_type']) && !empty($_REQUEST['alert_message'])) { ?>
    <div data-notify="container" class="col-xs-11 col-sm-3 alert <?php echo $_REQUEST['alert_type'] ?> animated fadeInDown" role="alert" data-notify-position="bottom-right" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out 0s; z-index: 999999; bottom: 30px; right: 30px; animation-iteration-count: 1;">
        <button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>
        <span data-notify="icon"></span>
        <span data-notify="title"> <?php echo $_REQUEST['alert_message']; ?> </span>
        <!-- <span data-notify="message">Turning standard Bootstrap alerts into awesome notifications</span> -->
        <a href="#" target="_blank" data-notify="url"></a>
    </div>
    <script>
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function() {
                $(this).remove();
            });
        }, 3000);
    </script>
<?php } ?>

<!-- [ navigation menu ] start -->
<nav class="pcoded-navbar menu-light ">
    <div class="navbar-wrapper">
        <div class="navbar-content scroll-div ">
            <ul class="nav pcoded-inner-navbar ">
                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link ">
                        <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                        <span class="pcoded-mtext">Category</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li><a href="category.php">Category Add</a></li>
                        <li><a href="categoryList.php">Category List</a></li>
                    </ul>
                </li>
                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link ">
                        <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                        <span class="pcoded-mtext">Users</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li><a href="userList.php">User List</a></li>
                    </ul>
                </li>
                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link ">
                        <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                        <span class="pcoded-mtext">Course</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li><a href="courseList.php">Course List</a></li>
                        <li><a href="course.php">Course Add</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- [ navigation menu ] end -->
<!-- [ Header ] start -->
<header class="navbar pcoded-header navbar-expand-lg navbar-light header-blue">
    <div class="m-header">
        <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
        <a href="#!" class="b-brand">
            <!-- ========   change your logo hear   ============ -->
            <img src="assets/images/logo.png" alt="" class="logo" height="40">
        </a>
        <a href="#!" class="mob-toggler">
            <i class="feather icon-more-vertical"></i>
        </a>
    </div>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a href="#!" class="pop-search"><i class="feather icon-search"></i></a>
                <div class="search-bar">
                    <input type="text" class="form-control border-0 shadow-none" placeholder="Search hear">
                    <button type="button" class="close" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li>
                <div class="dropdown">
                    <a class="dropdown-toggle" href="#" data-toggle="dropdown"><i class="icon feather icon-bell"></i></a>
                    <div class="dropdown-menu dropdown-menu-right notification">
                        <div class="noti-head">
                            <h6 class="d-inline-block m-b-0">Notifications</h6>
                            <div class="float-right">
                                <a href="#!" class="m-r-10">mark as read</a>
                                <a href="#!">clear all</a>
                            </div>
                        </div>
                        <ul class="noti-body">
                            <li class="n-title">
                                <p class="m-b-0">NEW</p>
                            </li>
                            <li class="notification">
                                <div class="media">
                                    <img class="img-radius" src="assets/images/user/avatar-1.jpg" alt="Generic placeholder image">
                                    <div class="media-body">
                                        <p><strong>John Doe</strong><span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>5 min</span></p>
                                        <p>New ticket Added</p>
                                    </div>
                                </div>
                            </li>
                            <li class="n-title">
                                <p class="m-b-0">EARLIER</p>
                            </li>
                            <li class="notification">
                                <div class="media">
                                    <img class="img-radius" src="assets/images/user/avatar-2.jpg" alt="Generic placeholder image">
                                    <div class="media-body">
                                        <p><strong>Joseph William</strong><span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>10 min</span></p>
                                        <p>Prchace New Theme and make payment</p>
                                    </div>
                                </div>
                            </li>
                            <li class="notification">
                                <div class="media">
                                    <img class="img-radius" src="assets/images/user/avatar-1.jpg" alt="Generic placeholder image">
                                    <div class="media-body">
                                        <p><strong>Sara Soudein</strong><span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>12 min</span></p>
                                        <p>currently login</p>
                                    </div>
                                </div>
                            </li>
                            <li class="notification">
                                <div class="media">
                                    <img class="img-radius" src="assets/images/user/avatar-2.jpg" alt="Generic placeholder image">
                                    <div class="media-body">
                                        <p><strong>Joseph William</strong><span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>30 min</span></p>
                                        <p>Prchace New Theme and make payment</p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <div class="noti-footer">
                            <a href="#!">show all</a>
                        </div>
                    </div>
                </div>
            </li>
            <li>
                <div class="dropdown drp-user">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="feather icon-user"></i>
                    </a>
                    <?php
                    $Condition['id'] = $_SESSION["adminId"];
                    $response = getData('admin', $Condition);
                    $response = $response->fetch_assoc();
                    ?>
                    <div class="dropdown-menu dropdown-menu-right profile-notification">
                        <div class="pro-head">
                            <img src="assets/images/user/avatar-1.jpg" class="img-radius" alt="User-Profile-Image">
                            <span><?php echo $response['full_name']; ?></span>
                            <a href="include/AdminSubmitData.php?&moduleMethod=logout&module=adminLogout&logout=1" class="dud-logout" title="Logout">
                                <i class="feather icon-log-out"></i>
                            </a>
                        </div>
                        <ul class="pro-body">
                            <li><a href="user-profile.html" class="dropdown-item"><i class="feather icon-user"></i>
                                    Profile</a></li>
                            <li><a href="email_inbox.html" class="dropdown-item"><i class="feather icon-mail"></i>
                                    My Messages</a></li>
                            <li><a href="auth-signin.html" class="dropdown-item"><i class="feather icon-lock"></i>
                                    Lock Screen</a></li>
                        </ul>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</header>
<!-- [ Header ] end -->