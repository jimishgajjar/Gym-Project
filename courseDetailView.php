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
                                <?php
                                if (!empty($_SESSION["userId"]) && !empty($_SESSION["userEmail"])) {
                                ?>
                                    <a href="#" class="detail-btn wishlist">
                                        <i class="far fa-heart"></i>
                                    </a>
                                <?php } ?>
                                <a href="#" class="detail-btn cart pl-5 pr-5">
                                    Add to cart
                                </a>
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

                        <div class="col-md-12 mt-40">
                            <hr>
                            <div class="courcse-video">

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

</body>

</html>