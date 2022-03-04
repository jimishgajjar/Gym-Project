<?php
date_default_timezone_set("Asia/Kolkata");
include('header.php');
$ip = getIPAddress();
?>
<style>
    #profile_pic {
        display: none;
    }

    .upload-pic {
        display: flex;
        flex-wrap: wrap;
    }
</style>

<body>
    <?php include('menu.php'); ?>

    <section class="user-dashboard">
        <div class="container pt-80">
            <div class="row justify-content-md-center pt-4">
                <div class="col-md-12">
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
                        <div class="cartlist">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <h4 class="title">User Cartlist</h4>
                                </div>
                            </div>
                            <hr>
                            <div class="cartlist-data">
                                <?php
                                $WhishlistCondition['user_id'] = "";
                                $WhishlistCondition['user_ip'] = $ip;
                                $userCartData = getData('cart', $WhishlistCondition);
                                $total = 0;
                                $totalAll = 0;
                                if ($userCartData->num_rows > 0) { ?>
                                    <div class="row">
                                        <div class="col-md-9">
                                            <?php while ($row = $userCartData->fetch_assoc()) {
                                                $Condition['id'] = $row['course_id'];
                                                $response = getData('course', $Condition);
                                                $response = $response->fetch_assoc();
                                                if (!empty($response)) { ?>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="course-img">
                                                                <img src="<?php echo $thumbnailPath . $response['thumbnail']; ?>" />
                                                                <div class="course-img-overlay">
                                                                </div>
                                                                <div class="heart"><a href="#"><i class="fas fa-heart fa-lg"></i></a></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <p>
                                                                <?php
                                                                if (strlen($response['title']) >= 80) {
                                                                    echo substr($response['title'], 0, 80) . "...";
                                                                } else {
                                                                    echo $response['title'];
                                                                }
                                                                ?>
                                                            </p>
                                                            <div class="course-rating">
                                                                <h6 class="course-rating-num">(<?php echo $response['rating']; ?>)</h6>
                                                                <span class="stars"><?php echo $response['rating']; ?></span>
                                                            </div>
                                                            <h6 style="font-weight: 700;">
                                                                <?php
                                                                if ($response['discount'] != 0) {
                                                                    $discountPrice = $response['price'] - ($response['price'] * $response['discount'] / 100);
                                                                    $total += $discountPrice;
                                                                    echo "₹" . $discountPrice . "<s style='color: #8c8c8c;' class='pl-2'>₹" . $response['price'] . "</s>";
                                                                } else {
                                                                    echo "₹" . $response['price'];
                                                                    $total += $response['price'];
                                                                }
                                                                $totalAll += $response['price'];
                                                                ?>
                                                            </h6>
                                                            <div class="d-flex bd-highlight">
                                                                <div class="pr-2 flex-fill bd-highlight"><a href="include/UserSubmitData.php?moduleMethod=cart&module=deleteCartFromDash&remove=<?php echo $row['id']; ?>">Remove</a></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr>
                                            <?php }
                                            } ?>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="p-2" style="background-color: #ffecec; border-radius: 10px;">
                                                <div class="d-flex flex-column bd-highlight">
                                                    <h5 style="font-weight: 100;">Total</h5>
                                                    <h3 style="font-weight: 700;">
                                                        <h4 style="letter-spacing: 0.5px; font-weight: 600;">₹<?php echo $total; ?></h4>
                                                        <h5 style="letter-spacing: 0.5px; font-weight: 600; color: #8c8c8c;"><s>₹<?php echo $totalAll; ?></s></h5>
                                                    </h3>
                                                    <a href="userLogin.php?from_checkout=1" class="mt-3 bt-boder-0 btn btn-primary btn-100">Checkout</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <h4 class="p-5">No products in the cart.</h4>
                                            <a class="mb-20 btn btn-primary" href="index.php">Browse courses now</a>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include('footer.php'); ?>
</body>

</html>