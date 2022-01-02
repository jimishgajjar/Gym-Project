<?php
include "include/dbConfig.php";
include "include/queryFunction.php";
include "checkSession.php";
$categoryPath = "assets/category/";
$thumbnailPath = "assets/thumbnail/";

$ip = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
?>


<?php
if (empty($_SESSION["userId"]) && empty($_SESSION["userEmail"])) {
    $cartCondition['user_ip'] = $ip;
    $cartCondition['user_id'] = null;
    $cartDataResponse = getData('cart', $cartCondition);
    $cartDataResponse = $cartDataResponse->fetch_assoc();
} else {
    $cartCondition['user_ip'] = $ip;
    $cartCondition['user_id'] = $_SESSION["userId"];
    $cartDataResponse = getData('cart', $cartCondition);
    $cartDataResponse = $cartDataResponse->fetch_assoc();
}

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
                } ?>
                <li class="cart-total">
                    <h5>Total: ₹<?php echo $total; ?><s class="pl-2">₹<?php echo $totalAll; ?></s></h5>
                </li>
            <?php } ?>
        </ul>
    </div>
<?php } ?>