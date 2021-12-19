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
                        <?php } else { ?>
                            <li>
                                <a href="include/userSubmitData.php?moduleMethod=logout&module=userLogout&logout=1">Logout</a>
                            </li>
                        <?php } ?>
                    </ul>
                    <div class="elementskit-nav-identity-panel">
                        <h1 class="elementskit-site-title">
                            <a class="elementskit-nav-logo" href="index-2.html">
                                <img src="assets/images/logo/logo-black.png" alt="navbar logo" height="100">
                            </a>
                        </h1>
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
                            <a href="include/UserSubmitData.php" class="offset-side-bar xs-modal-popup">
                                <i class="icon icon-cart"></i>
                                <span class="xs-badge">0</span>
                            </a>
                        <?php } else { ?>
                            <a href="include/UserSubmitData.php" class="offset-side-bar xs-modal-popup">
                                <i class="icon icon-cart"></i>
                                <span class="xs-badge"><?php echo $cartCount; ?></span>
                            </a>
                        <?php } ?>
                    </li>
                <?php } else { ?>
                    <li>
                        <a href="include/UserSubmitData.php" class="offset-side-bar xs-modal-popup">
                            <i class="fas fa-heart"></i>
                        </a>
                    </li>
                    <li>
                        <?php
                        $cartCondition['user_id'] = $_SESSION["userId"];
                        $cartCondition['user_ip'] = $ip;
                        $cartDataResponse = getData('cart', $cartCondition);
                        $cartCount = $cartDataResponse->num_rows;
                        if (empty($cartDataResponse)) {
                        ?>
                            <a href="#" class="offset-side-bar xs-modal-popup">
                                <i class="icon icon-cart"></i>
                                <span class="xs-badge">0</span>
                            </a>
                        <?php } else { ?>
                            <a href="#" class="offset-side-bar xs-modal-popup">
                                <i class="icon icon-cart"></i>
                                <span class="xs-badge"><?php echo $cartCount; ?></span>
                            </a>
                        <?php } ?>
                    </li>
                    <li>
                        <a href="include/UserSubmitData.php" class="offset-side-bar xs-modal-popup">
                            <i class="fas fa-user"></i>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</header>

<div class="zoom-anim-dialog mfp-hide modal-searchPanel" id="modal-popup-2">
    <div class="xs-search-panel">
        <form action="#" method="POST" class="xs-search-group">
            <input type="search" class="form-control" name="search" id="search" placeholder="Search">
            <button type="submit" class="search-button"><i class="far fa-search"></i></button>
        </form>
    </div>
</div>

<div class="xs-sidebar-group cart-group">
    <div class="xs-overlay xs-bg-black"></div>
    <div class="xs-sidebar-widget">
        <div class="sidebar-widget-container">
            <div class="widget-heading media">
                <div class="media-body">
                    <a href="#" class="close-side-widget">
                        <i class="icon icon-cancel"></i>
                    </a>
                </div>
            </div>
            <div class="xs-empty-content">
                <ul>
                    <li>
                        My Profile
                    </li>
                    <li>
                        My Profile
                    </li>
                </ul>
                <!-- <h3 class="widget-title">Shopping cart</h3>
                <h4 class="xs-title">No products in the cart.</h4>
                <p class="empty-cart-icon">
                    <i class="icon icon-shopping-cart"></i>
                </p>
                <p class="xs-btn-wraper">
                    <a class="btn btn-primary" href="#">Return To Shop</a>
                </p> -->
            </div>
        </div>
    </div>
</div>

<div class="xs-sidebar-group info-group">
    <div class="xs-overlay xs-bg-black"></div>
    <div class="xs-sidebar-widget">
        <div class="sidebar-widget-container">
            <div class="widget-heading">
                <a href="#" class="close-side-widget">
                    <i class="icon icon-cancel"></i>
                </a>
            </div>
            <div class="sidebar-textwidget">
                <div class="sidebar-logo-wraper">
                    <a href="index.php">
                        <img src="assets/images/logo/logo-black.png" alt="sidebar logo" height="100" draggable="false">
                    </a>
                </div>
                <div class="xs-sidbar-getintouch">
                    <h6 class="mb-3">Get in Touch</h6>
                    <ul class="sideabr-list-widget">
                        <li> <i class="icon icon-location"></i> 224 West 20th St, New York</li>
                        <li><i class="icon icon-paper-plane"></i> NY 10011, USA</li>
                        <li> <i class="icon icon-phone-call"></i>+1 212-255-5511</li>
                        <li> <i class="icon icon-email"></i><a href="https://html.xpeedstudio.com/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="d0b9beb6bf90a8a0b5b5b4a3a4a5b4b9bffeb3bfbd">[email&#160;protected]</a>
                        </li>
                    </ul>
                </div>
                <div class="xs-instra-feed">
                    <p class="text-primary"><strong>@gemvast</strong></p>
                    <ul>
                        <li><img src="assets/images/instrafeed/1.jpg" alt=""></li>
                        <li><img src="assets/images/instrafeed/2.jpg" alt=""></li>
                        <li><img src="assets/images/instrafeed/3.jpg" alt=""></li>
                    </ul>
                </div>
                <div class="xs-sidebar-image">
                    <img src="assets/images/muscle_man.png" alt="muscle man">
                </div>
            </div>
        </div>
    </div>
</div>