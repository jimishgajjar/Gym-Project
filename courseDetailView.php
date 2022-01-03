<?php
date_default_timezone_set("Asia/Kolkata");
session_start();
include('header.php');
?>

<body>
    <?php include('menu.php'); ?>

    <?php
    $Condition['id'] = $_GET['view'];
    $response = getData('course', $Condition);
    $response = $response->fetch_assoc();

    if (!empty($response)) {
        $categoryCondition['id'] = $response['category_id'];
        $categoryresponse = getData('category', $categoryCondition);
        $categoryresponse = $categoryresponse->fetch_assoc();
        if (empty($categoryresponse)) {
            echo "<script>window.location.replace('index.php');</script>";
        }
    ?>
        <section class="course-detail">
            <div class="course-detail-header">
                <div class="container">
                    <div class="row pb-5">
                        <div class="col-md-12 mb-10">
                            <ol class="cd-breadcrumb">
                                <li><a href="index.php">Home</a></li>
                                <li><a href="courceCategory.php"><?php echo $categoryresponse['category_name']; ?></a></li>
                            </ol>
                        </div>
                        <div class="col-md-8 col-md-push-8">
                            <div class="course-detail-title">
                                <h4><?php echo $response['title']; ?></h4>
                            </div>
                            <div class="course-detail-description">
                                <p>
                                    <?php echo $response['small_description']; ?>
                                </p>
                            </div>
                            <div class="course-rating mb-2">
                                <h6 class="course-rating-num">(<?php echo $response['rating']; ?>)</h6>
                                <span class="stars"><?php echo $response['rating']; ?></span>
                            </div>
                            <div class="price-tag mb-2">
                                <h3><span>₹</span> <?php echo $response['price']; ?>/- </h3>
                            </div>
                            <div class="course-detail-price mb-20">
                                <?php if (empty($_SESSION["userId"]) && empty($_SESSION["userEmail"])) { ?>
                                    <?php
                                    $cartCondition['user_ip'] = $ip;
                                    $cartCondition['user_id'] = null;
                                    $cartCondition['cource_id'] = $_GET['view'];
                                    $cartDataResponse = getData('cart', $cartCondition);
                                    $cartDataResponse = $cartDataResponse->fetch_assoc();
                                    if (empty($cartDataResponse)) {
                                    ?>
                                        <a href="include/UserSubmitData.php?moduleMethod=cart&module=cartAdd&cartId=<?php echo $response['id']; ?>" class="detail-btn cart pl-5 pr-5">
                                            Add to cart
                                        </a>
                                    <?php } else { ?>
                                        <a href="javascript:void(0);" onclick="loadWishlist();" class="offset-side-bar-wishlist xs-modal-popup detail-btn cart pl-5 pr-5">
                                            Go to cart
                                        </a>
                                    <?php } ?>
                                <?php } else { ?>
                                    <?php
                                    $WACondition['user_id'] = $_SESSION["userId"];
                                    $WACondition['cource_id'] = $_GET['view'];
                                    $wishlistDataResponse = getData('wishlist', $WACondition);
                                    $wishlistDataResponse = $wishlistDataResponse->fetch_assoc();
                                    if (empty($wishlistDataResponse)) {
                                    ?>
                                        <a href="include/UserSubmitData.php?moduleMethod=wishlist&module=wishlistAdd&whislistId=<?php echo $response['id']; ?>" class="detail-btn wishlist">
                                            <i class="far fa-heart"></i>
                                        </a>
                                    <?php } else { ?>
                                        <a href="include/UserSubmitData.php?moduleMethod=wishlist&module=wishlistDelete&whislistId=<?php echo $response['id']; ?>" class="detail-btn wishlist">
                                            <i class="fas fa-heart"></i>
                                        </a>
                                    <?php } ?>
                                    <?php
                                    $cartDataResponse = getData('cart', $WACondition);
                                    $cartDataResponse = $cartDataResponse->fetch_assoc();
                                    if (empty($cartDataResponse)) {
                                    ?>
                                        <a href="include/UserSubmitData.php?moduleMethod=cart&module=cartAdd&cartId=<?php echo $response['id']; ?>" class="detail-btn pl-5 pr-5">
                                            Add to cart
                                        </a>
                                    <?php } else { ?>
                                        <a href="javascript:void(0);" onclick="loadCartlist();" class="offset-side-bar-cart xs-modal-popup detail-btn cart pl-5 pr-5">
                                            Go to cart
                                        </a>
                                    <?php } ?>
                                <?php } ?>
                                <a href="#" class="detail-btn buy pl-5 pr-5">
                                    Buy now
                                </a>
                            </div>
                        </div>
                        <div class="col-md-4 col-md-pull-4">
                            <img class="course-thumbline" src="<?php echo $thumbnailPath . $response['thumbnail']; ?>" style="border-radius: 10px;" alt="course1">
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="pt-40">
                    <div class="row justify-content-md-center">
                        <div class="col-md-12">
                            <hr>
                            <div class="course-description">
                                <h4>Description</h4>
                                <p>
                                    <?php echo $response['description']; ?>
                                </p>
                            </div>
                        </div>

                        <div class="col-md-12 mt-20">
                            <hr>
                            <div class="course-video">
                                <h4 class="mb-20">Course content</h4>
                                <div class="panel-group">
                                    <div class="panel panel-default cource-chapter">
                                        <a class="cource-chapter-click" data-toggle="collapse" href="#collapse1">
                                            <div class="cource-chapter-title">
                                                <i class="fal fa-chevron-down pr-20"></i>
                                                Course content
                                            </div>
                                        </a>
                                        <div id="collapse1" class="panel-collapse collapse">
                                            <div class="cource-chapter-body">
                                                <ul>
                                                    <li>
                                                        <i class="fas fa-play-circle pr-20"></i>
                                                        <a href="">Course content</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php } else { ?>
        <section class="course-detail">
            <div class="course-detail-header">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-danger" role="alert">
                                Data not found !
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php } ?>

    <?php include('footer.php'); ?>
    <script>
        $('.cource-chapter-click').click(function() {
            $(this).find('i').toggleClass('fal fa-chevron-down fal fa-chevron-up');
        });
    </script>
</body>

</html>