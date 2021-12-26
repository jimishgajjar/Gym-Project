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
                        <?php } ?>
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
                            <a href="#" class="offset-side-bar-cart xs-modal-popup">
                                <i class="far fa-shopping-cart"></i>
                                <span class="xs-badge">0</span>
                            </a>
                        <?php } else { ?>
                            <a href="#" class="offset-side-bar-cart xs-modal-popup">
                                <i class="far fa-shopping-cart"></i>
                                <span class="xs-badge"><?php echo $cartCount; ?></span>
                            </a>
                        <?php } ?>
                    </li>
                <?php } else { ?>
                    <li>
                        <a href="#" class="offset-side-bar-wishlist xs-modal-popup">
                            <i class="far fa-heart"></i>
                        </a>
                    </li>
                    <li>
                        <?php
                        $cartCondition['user_ip'] = $ip;
                        $cartCondition['user_id'] = $_SESSION["userId"];
                        $cartDataResponse = getData('cart', $cartCondition);
                        $cartCount = $cartDataResponse->num_rows;
                        if (empty($cartDataResponse)) {
                        ?>
                            <a href="#" class="offset-side-bar-cart xs-modal-popup">
                                <i class="far fa-shopping-cart"></i>
                                <span class="xs-badge">0</span>
                            </a>
                        <?php } else { ?>
                            <a href="#" class="offset-side-bar-cart xs-modal-popup">
                                <i class="far fa-shopping-cart"></i>
                                <span class="xs-badge"><?php echo $cartCount; ?></span>
                            </a>
                        <?php } ?>
                    </li>
                    <li>
                        <a href="#" class="offset-side-bar-profile xs-modal-popup">
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
        <form action="#" method="POST" class="xs-search-group">
            <input type="search" class="form-control" name="search" id="search" placeholder="Search">
            <button type="submit" class="search-button"><i class="far fa-search"></i></button>
        </form>
    </div>
</div>

<div class="xs-sidebar-group whislist-group">
    <div class="xs-overlay xs-bg-black"></div>
    <div class="xs-sidebar-widget xs-sidebar-widget-cart">
        <div class="sidebar-widget-container">
            <div class="widget-heading media">
                <div class="media-body">
                    <a href="#" class="close-side-widget">
                        <i class="icon icon-cancel"></i>
                    </a>
                </div>
            </div>
            <?php
            $WhishlistCondition['user_id'] = $_SESSION["userId"];
            $wishlistData = getData('wishlist', $WhishlistCondition);
            if (empty($wishlistData)) {
            ?>
                <div class="xs-empty-content">
                    <h3 class="widget-title">Whislist</h3>
                    <h4 class="xs-title">No products in your wishlist.</h4>
                    <p class="empty-cart-icon">
                        <i class="far fa-heart"></i>
                    </p>
                    <p class="xs-btn-wraper">
                        <a class="btn btn-primary" href="index.php">Return To Shop</a>
                    </p>
                </div>
            <?php } else { ?>
                <!-- <div class="user-whislist"> -->
                <div class="user-cart">
                    <ul>
                        <?php
                        $total = 0;
                        $totalAll = 0;
                        if ($wishlistData->num_rows > 0) {
                            while ($row = $wishlistData->fetch_assoc()) {
                                $Condition['id'] = $row['cource_id'];
                                $response = getData('course', $Condition);
                                $response = $response->fetch_assoc();
                                if (!empty($response)) { ?>
                                    <li>
                                        <div class="user-cart-list">
                                            <img src="<?php echo $thumbnailPath . $response['thumbnail']; ?>" />
                                            <div class="row pl-2">
                                                <div class="col-md-12">
                                                    <p>
                                                        <?php
                                                        if (strlen($response['title']) >= 50) {
                                                            echo substr($response['title'], 0, 50) . "...";
                                                        } else {
                                                            echo $response['title'];
                                                        }
                                                        ?>
                                                    </p>
                                                </div>
                                                <div class="col-md-12 pt-2">
                                                    <h6 style="font-weight: 700;">
                                                        <?php
                                                        if ($response['discount'] != 0) {
                                                            $discountPrice = $response['price'] - ($response['price'] * $response['discount'] / 100);
                                                            $total += $discountPrice;
                                                            echo "₹" . $discountPrice . "<s class='pl-2'>₹" . $response['price'] . "</s>";
                                                        } else {
                                                            echo "₹" . $response['price'];
                                                            $total += $response['price'];
                                                        }
                                                        $totalAll += $response['price'];
                                                        ?>
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="user-cart-content">
                                            <a href="javascript:void(0);" onclick="addToCartFromWishlist();" class="tp-btn btn-block">
                                                Add to cart
                                            </a>
                                        </div>
                                    </li>
                        <?php }
                            }
                        } ?>
                        <li class="cart-total">
                            <h5>Total: ₹<?php echo $total; ?><s class="pl-2">₹<?php echo $totalAll; ?></s></h5>
                        </li>
                    </ul>
                </div>
                <!-- </div> -->
            <?php } ?>
        </div>
    </div>
</div>

<div class="xs-sidebar-group cart-group">
    <div class="xs-overlay xs-bg-black"></div>
    <div class="xs-sidebar-widget xs-sidebar-widget-cart">
        <div class="sidebar-widget-container">
            <div class="widget-heading media">
                <div class="media-body">
                    <a href="#" class="close-side-widget">
                        <i class="icon icon-cancel"></i>
                    </a>
                </div>
            </div>
            <?php
            if (empty($cartDataResponse)) {
            ?>
                <div class="xs-empty-content">
                    <h3 class="widget-title">Shopping cart</h3>
                    <h4 class="xs-title">No products in the cart.</h4>
                    <p class="empty-cart-icon">
                        <i class="icon icon-shopping-cart"></i>
                    </p>
                    <p class="xs-btn-wraper">
                        <a class="btn btn-primary" href="index.php">Return To Shop</a>
                    </p>
                </div>
            <?php } else { ?>
                <div class="user-cart">
                    <ul>
                        <?php
                        $total = 0;
                        $totalAll = 0;
                        if ($cartDataResponse->num_rows > 0) {
                            while ($row = $cartDataResponse->fetch_assoc()) {
                                $Condition['id'] = $row['cource_id'];
                                $response = getData('course', $Condition);
                                $response = $response->fetch_assoc();
                                if (!empty($response)) {                        ?>
                                    <li>
                                        <div class="user-cart-list">
                                            <img src="<?php echo $thumbnailPath . $response['thumbnail']; ?>" />
                                            <div class="row pl-2">
                                                <div class="col-md-12">
                                                    <p>
                                                        <?php
                                                        if (strlen($response['title']) >= 50) {
                                                            echo substr($response['title'], 0, 50) . "...";
                                                        } else {
                                                            echo $response['title'];
                                                        }
                                                        ?>
                                                    </p>
                                                </div>
                                                <div class="col-md-12 pt-2">
                                                    <h6 style="font-weight: 700;">
                                                        <?php
                                                        if ($response['discount'] != 0) {
                                                            $discountPrice = $response['price'] - ($response['price'] * $response['discount'] / 100);
                                                            $total += $discountPrice;
                                                            echo "₹" . $discountPrice . "<s class='pl-2'>₹" . $response['price'] . "</s>";
                                                        } else {
                                                            echo "₹" . $response['price'];
                                                            $total += $response['price'];
                                                        }
                                                        $totalAll += $response['price'];
                                                        ?>
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                        <?php }
                            }
                        } ?>

                        <li class="cart-total">
                            <h5>Total: ₹<?php echo $total; ?><s class="pl-2">₹<?php echo $totalAll; ?></s></h5>
                        </li>
                    </ul>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<div class="xs-sidebar-group profile-group">
    <div class="xs-overlay xs-bg-black"></div>
    <div class="xs-sidebar-widget">
        <div class="sidebar-widget-container">
            <div class="widget-heading">
                <a href="#" class="close-side-widget">
                    <i class="icon icon-cancel"></i>
                </a>
            </div>
            <div class="sidebar-textwidget">
                <ul class="user-menu">
                    <li>
                        <a href="#"><i class="far fa-user pr-20"></i> My Profile</a>
                    </li>
                    <li>
                        <a href="#"><i class="far fa-heart pr-20"></i> Whish List</a>
                    </li>
                    <li>
                        <a href="#"><i class="far fa-shopping-cart pr-20"></i> Cart</a>
                    </li>
                    <li>
                        <a href="include/userSubmitData.php?moduleMethod=logout&module=userLogout&logout=1"><i class="fal fa-power-off pr-20"></i> Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>