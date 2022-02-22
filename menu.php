<?php
$ip = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
?>
<header class="elementskit-header xs-header-transparent">
    <div class="container">
        <div class="xs-navbar">
            <a class="xs-navbar-brand" href="index.php">
                <img src="assets/images/logo/logo-black.png" alt="navbar logo">
            </a>
            <nav class="elementskit-navbar ml-auto">
                <button class="elementskit-menu-hamburger elementskit-menu-toggler">
                    <span class="elementskit-menu-hamburger-icon"></span>
                    <span class="elementskit-menu-hamburger-icon"></span>
                    <span class="elementskit-menu-hamburger-icon"></span>
                </button>

                <div class="elementskit-menu-container elementskit-menu-offcanvas-elements">
                    <ul class="elementskit-navbar-nav nav-alignment-dynamic">
                        <li>
                            <a href="index.php">Home</a>
                        </li>
                        <?php
                        if (empty($_SESSION["userId"]) && empty($_SESSION["userEmail"])) { ?>
                            <li>
                                <a href="userLogin.php">Login</a>
                            </li>
                        <?php } else {
                            $userCondition['id'] = $_SESSION["userId"];
                            $userCondition['email'] = $_SESSION["userEmail"];
                            $userDataResponse = getData('user', $userCondition);
                            $userDataResponse = $userDataResponse->fetch_assoc();
                        } ?>
                    </ul>
                    <div class="elementskit-nav-identity-panel">
                        <button class="elementskit-menu-close elementskit-menu-toggler" type="button">
                            <i class="icon icon-cancel"></i>
                        </button>
                    </div>
                </div>
                <div class="elementskit-menu-overlay elementskit-menu-offcanvas-elements elementskit-menu-toggler">
                </div>
            </nav>
            <ul class="xs-menu-tools">
                <li>
                    <a href="#modal-popup-2" class="navsearch-button xs-modal-popup">
                        <i class="far fa-search"></i>
                    </a>
                </li>
                <?php if (empty($_SESSION["userId"]) && empty($_SESSION["userEmail"])) { ?>
                    <li>
                        <?php
                        $cartCondition['user_ip'] = $ip;
                        $cartCondition['user_id'] = null;
                        $cartDataResponse = getData('cart', $cartCondition);
                        $cartCount = $cartDataResponse->num_rows;
                        if (empty($cartDataResponse)) {
                        ?>
                            <a href="javascript:void(0);" onclick="loadCartlist();" class="offset-side-bar-cart xs-modal-popup">
                                <i class="far fa-shopping-cart"></i>
                                <span class="xs-badge">0</span>
                            </a>
                        <?php } else { ?>
                            <a href="javascript:void(0);" onclick="loadCartlist();" class="offset-side-bar-cart xs-modal-popup">
                                <i class="far fa-shopping-cart"></i>
                                <span class="xs-badge"><?php echo $cartCount; ?></span>
                            </a>
                        <?php } ?>
                    </li>
                <?php } else { ?>
                    <li>
                        <a href="javascript:void(0);" onclick="loadWishlist();" class="offset-side-bar-wishlist xs-modal-popup">
                            <i class="far fa-heart"></i>
                        </a>
                    </li>
                    <li>
                        <?php
                        $cartCondition['user_ip'] = $ip;
                        $cartCondition['user_id'] = $_SESSION["userId"];
                        $cartDataResponse = getData('cart', $cartCondition);
                        $cartCount = $cartDataResponse->num_rows;
                        ?>
                        <a href="javascript:void(0);" onclick="loadCartlist();" class="offset-side-bar-cart xs-modal-popup">
                            <i class="far fa-shopping-cart"></i>
                            <span class="xs-badge"><?php echo $cartCount; ?></span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="offset-side-bar-profile xs-modal-popup">
                            <i class="far fa-user"></i>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</header>

<div class="zoom-anim-dialog mfp-hide modal-searchPanel" id="modal-popup-2">
    <div class="xs-search-panel">
        <!-- <form action="#" method="POST" class="xs-search-group"> -->
        <div class="xs-search-group">
            <div class="mb-4">
                <input type="search" class="form-control" name="search" id="search" onkeyup="courseSearch(this);" placeholder="Search">
                <!-- <button type="submit" class="search-button"><i class="far fa-search"></i></button> -->
            </div>
            <div class="xs-search-group-content" id="search_content">
                <ul>
                    <li>
                        <a href="javascript:void(0);">
                            Search Something...
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- </form> -->
    </div>
</div>

<div class="xs-sidebar-group whislist-group">
    <div class="xs-overlay xs-bg-black"></div>
    <div class="xs-sidebar-widget xs-sidebar-widget-cart">
        <div class="sidebar-widget-container">
            <div class="widget-heading media">
                <div class="media-body">
                    <a href="javascript:void(0);" class="close-side-widget">
                        <i class="icon icon-cancel"></i>
                    </a>
                </div>
            </div>
            <div id="whislist-data">

            </div>
        </div>
    </div>
</div>

<div class="xs-sidebar-group cart-group">
    <div class="xs-overlay xs-bg-black"></div>
    <div class="xs-sidebar-widget xs-sidebar-widget-cart">
        <div class="sidebar-widget-container">
            <div class="widget-heading media">
                <div class="media-body">
                    <a href="javascript:void(0);" class="close-side-widget">
                        <i class="icon icon-cancel"></i>
                    </a>
                </div>
            </div>
            <div id="cartlist-data">

            </div>
        </div>
    </div>
</div>

<div class="xs-sidebar-group profile-group">
    <div class="xs-overlay xs-bg-black"></div>
    <div class="xs-sidebar-widget">
        <div class="sidebar-widget-container">
            <div class="widget-heading">
                <a href="javascript:void(0);" class="close-side-widget">
                    <i class="icon icon-cancel"></i>
                </a>
            </div>
            <div class="sidebar-textwidget">
                <ul class="user-menu">
                    <li>
                        <a href="userDashboard.php?dasboard=userprofile"><i class="far fa-user pr-20"></i> My Profile</a>
                    </li>
                    <li>
                        <a href="userDashboard.php?dasboard=mycourse"><i class="fas fa-play pr-20"></i> My Course</a>
                    </li>
                    <li>
                        <a href="userDashboard.php?dasboard=myprogress"><i class="fas fa-tasks pr-20"></i> My Progress</a>
                    </li>
                    <li>
                        <a href="userDashboard.php?dasboard=wishlist"><i class="far fa-heart pr-20"></i> Wishlist</a>
                    </li>
                    <li>
                        <a href="userDashboard.php?dasboard=cartlist"><i class="far fa-shopping-cart pr-20"></i> Cart</a>
                    </li>
                    <li>
                        <a href="include/userSubmitData.php?moduleMethod=logout&module=userLogout&logout=1"><i class="fal fa-power-off pr-20"></i> Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>