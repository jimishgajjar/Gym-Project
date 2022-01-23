<?php
include "include/dbConfig.php";
include "include/queryFunction.php";
include "checkSession.php";
$categoryPath = "assets/category/";
$thumbnailPath = "assets/thumbnail/";
?>

<?php
$WhishlistCondition['user_id'] = $_SESSION["userId"];
$wishlistData = getData('wishlist', $WhishlistCondition);
if ($wishlistData->num_rows > 0) {
?>
    <div class="user-cart">
        <ul>
            <?php
            $total = 0;
            $totalAll = 0;
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
                            <a href="javascript:void(0);" onclick="addToCartFromWishlist('<?php echo $row['cource_id']; ?>');" class="tp-btn btn-block">
                                Add to cart
                            </a>
                            <a href="javascript:void(0);" onclick="deleteFromWishlist('<?php echo $row['cource_id']; ?>');" class="tp-btn" style="width: 50px;">
                                <i class="fas fa-heart"></i>
                            </a>
                        </div>
                    </li>
            <?php }
            }
            ?>
            <li class="cart-total">
                <h5>Total: ₹<?php echo $total; ?><s class="pl-2">₹<?php echo $totalAll; ?></s></h5>
            </li>
        </ul>
    </div>
<?php } else { ?>
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
<?php } ?>