<?php
session_start();
include "include/dbConfig.php";
include "include/queryFunction.php";
$categoryPath = "assets/category/";
$thumbnailPath = "assets/thumbnail/";
$ip = getIPAddress();

$total = 0;
$totalAll = 0;
?>

<?php
if (!empty($_SESSION["userId"]) && !empty($_SESSION["userEmail"])) {
    $cartCondition['user_id'] = $_SESSION["userId"];
    $cartDataResponse = getData('cart', $cartCondition);
}

if (!empty($_SESSION["userId"]) && !empty($_SESSION["userEmail"]) && !empty(getData('cart', $cartCondition)->fetch_assoc())) {
?>
    <div class="user-cart">
        <ul>
            <?php
            while ($row = $cartDataResponse->fetch_assoc()) {
                $Condition['id'] = $row['course_id'];
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
                                <div class="col-md-8 pt-2">
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
            } ?>
            <li class="cart-total">
                <h5>Total: ₹<?php echo $total; ?><s class="pl-2">₹<?php echo $totalAll; ?></s></h5>
            </li>
            <li class="cart-total">
                <a href="userDashboard.php?dasboard=cartlist" class="tp-btn btn-block">
                    Checkout
                </a>
            </li>
        </ul>
    </div>
<?php } elseif (isset($_COOKIE['cartCookie']) && !empty(json_decode($_COOKIE['cartCookie']))) {
    $cartArray = json_decode($_COOKIE['cartCookie'])
?>
    <div class="user-cart">
        <ul>
            <?php
            foreach ($cartArray as $course_id) {
                $Condition['id'] = $course_id;
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
                                <div class="col-md-8 pt-2">
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
            } ?>
            <li class="cart-total">
                <h5>Total: ₹<?php echo $total; ?><s class="pl-2">₹<?php echo $totalAll; ?></s></h5>
            </li>
            <li class="cart-total">
                <a href="checkout.php" class="tp-btn btn-block">
                    Checkout
                </a>
            </li>
        </ul>
    </div>
<?php } else { ?>
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
<?php } ?>