<?php
date_default_timezone_set("Asia/Kolkata");
include('checkSession.php');
include('header.php');
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
        <div class="container pt-120">

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

            <div class="checkout">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h4 class="title">Checkout</h4>
                    </div>
                </div>
                <hr>
                <form action="include/UserSubmitData.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="module" value="coursesPayment">
                    <input type="hidden" name="moduleMethod" value="payment">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="row justify-content-md-center">
                                <div class="col-md-12">
                                    <div class="form-group xs-form-anim">
                                        <label class="input-label" for="nameoncard">Name on card</label>
                                        <input type="text" id="nameoncard" name="nameoncard" placeholder="Name On Card" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group xs-form-anim">
                                        <label class="input-label" for="cardno">Card Number</label>
                                        <input type="text" id="cardno" name="cardno" placeholder="Card Number" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        $WhishlistCondition['user_id'] = $_SESSION["userId"];
                        $userCartData = getData('cart', $WhishlistCondition);
                        $total = 0;
                        $totalAll = 0;
                        $discountAmount = 0;
                        if ($userCartData->num_rows > 0) {
                            while ($row = $userCartData->fetch_assoc()) {
                                $Condition['id'] = $row['course_id'];
                                $response = getData('course', $Condition);
                                $response = $response->fetch_assoc();
                                if (!empty($response)) {
                                    if ($response['discount'] != 0) {
                                        $discountAmount = ($response['price'] * $response['discount'] / 100);
                                        $discountPrice = $response['price'] - ($response['price'] * $response['discount'] / 100);
                                        $total += $discountPrice;
                                    } else {
                                        $total += $response['price'];
                                    }
                                    $totalAll += $response['price'];
                                }
                            }
                        }
                        ?>
                        <div class="col-md-4">
                            <div class="p-2" style="background-color: #ffecec; border-radius: 10px;">
                                <h5 class="mb-4" style="font-weight: 700;"><b></b>Summary</h5>
                                <div style="font-size: 19px;">
                                    <div class="row">
                                        <div class="col-sm">
                                            Original price:
                                        </div>
                                        <div class="col-sm text-right">
                                            ₹<?php echo $totalAll; ?>
                                        </div>
                                    </div>
                                    <?php if ($discountAmount != 0) { ?>
                                        <div class="row">
                                            <div class="col-sm">
                                                Discounted Price:
                                            </div>
                                            <div class="col-sm text-right">
                                                - ₹<?php echo $discountAmount; ?>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm">
                                            <h5 style="font-weight: 650;">Total</h5>
                                        </div>
                                        <div class="col-sm text-right">
                                            <h5 style="font-weight: 650;">₹<?php echo $total; ?></h5>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" name="" class="mt-3 bt-boder-0 btn btn-primary btn-100">Complete Payment</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <?php include('footer.php'); ?>
</body>

</html>