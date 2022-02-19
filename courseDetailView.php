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
                                <li><a href="courseCategory.php"><?php echo $categoryresponse['category_name']; ?></a></li>
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
                                <?php if (empty($_SESSION["userId"]) && empty($_SESSION["userEmail"])) {
                                    $cartCondition['user_ip'] = $ip;
                                    $cartCondition['user_id'] = null;
                                    $cartCondition['course_id'] = $_GET['view'];
                                    $cartDataResponse = getData('cart', $cartCondition);
                                    $cartDataResponse = $cartDataResponse->fetch_assoc();
                                    if (empty($cartDataResponse)) {
                                ?>
                                        <a href="include/UserSubmitData.php?moduleMethod=cart&module=cartAdd&cartId=<?php echo $response['id']; ?>" class="detail-btn cart pl-5 pr-5">
                                            Add to cart
                                        </a>
                                    <?php } else { ?>
                                        <a href="javascript:void(0);" onclick="loadCartlist();" class="offset-side-bar-cart xs-modal-popup detail-btn cart pl-5 pr-5">
                                            Go to cart
                                        </a>
                                    <?php } ?>
                                    <a href="#" class="detail-btn buy pl-5 pr-5">
                                        Buy now
                                    </a>
                                <?php } else { ?>
                                    <?php
                                    $userCoursesCondition['user_id'] = $_SESSION["userId"];
                                    $userCoursesCondition['course_id'] = $_GET['view'];
                                    $userCoursesResponse = getData('user_courses', $userCoursesCondition);
                                    $userCoursesResponse = $userCoursesResponse->fetch_assoc();
                                    if (!empty($userCoursesResponse)) {
                                        $courseChapterCondition['course_id'] = $_GET['view'];
                                        $courseChapterResponse = getData('course_chapter', $courseChapterCondition);
                                        $courseChapterResponse = $courseChapterResponse->fetch_assoc();

                                        $courseCountentCondition['chapter_id'] = $courseChapterResponse['id'];
                                        $courseCountentResponse = getData('course_content', $courseCountentCondition);
                                        $courseCountentResponse = $courseCountentResponse->fetch_assoc();
                                    ?>
                                        <a href="courseContentView.php?view=<?php echo $courseCountentResponse['course_id']; ?>&course_content_id=<?php echo $courseCountentResponse['id']; ?>" class="detail-btn pl-5 pr-5">
                                            Go to course
                                        </a>
                                        <?php } else {
                                        $WACondition['user_id'] = $_SESSION["userId"];
                                        $WACondition['course_id'] = $_GET['view'];
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
                                        <a href="#" class="detail-btn buy pl-5 pr-5">
                                            Buy now
                                        </a>
                                <?php
                                    }
                                } ?>
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
                            <?php
                            if (!empty($userCoursesResponse)) { ?>
                                <div class="course-video">
                                    <h4>Course content</h4>
                                    <?php
                                    $courseChapterCondition['course_id'] = $_GET['view'];
                                    $courseChapterResponse = getData('course_chapter', $courseChapterCondition);
                                    if ($courseChapterResponse->num_rows > 0) {
                                        while ($row = $courseChapterResponse->fetch_assoc()) {
                                    ?>
                                            <div class="panel-group">
                                                <div class="panel panel-default course-chapter">
                                                    <a class="course-chapter-click" data-toggle="collapse" href="#<?php echo $row['id']; ?>">
                                                        <div class="course-chapter-title">
                                                            <i class="fal fa-chevron-down pr-20"></i>
                                                            <?php echo $row['chapter_title']; ?>
                                                        </div>
                                                    </a>
                                                    <div id="<?php echo $row['id']; ?>" class="panel-collapse collapse">
                                                        <div class="course-chapter-body">
                                                            <ul>
                                                                <?php
                                                                $courseContentCondition['chapter_id'] = $row['id'];
                                                                $courseContentResponse = getData('course_content', $courseContentCondition);
                                                                if ($courseContentResponse->num_rows > 0) {
                                                                    while ($courseContentRow = $courseContentResponse->fetch_assoc()) {
                                                                        $file_extension = explode(".", $courseContentRow['document_path']);
                                                                        if ($file_extension[1] == "pdf") { ?>
                                                                            <li>
                                                                                <a href="<?php echo $coursePath . $courseContentRow['document_path']; ?>" target="_blank" class="text-center">
                                                                                    <i class="fas fa-file-pdf pr-20"></i>
                                                                                </a>
                                                                                <a href="<?php echo $coursePath . $courseContentRow['document_path']; ?>" target="_blank">
                                                                                    <?php echo $courseContentRow['doc_title']; ?>
                                                                                </a>
                                                                            </li>
                                                                        <?php } else {
                                                                        ?>
                                                                            <li>
                                                                                <a href="courseContentView.php?view=<?php echo $courseContentRow['course_id']; ?>&course_content_id=<?php echo $courseContentRow['id']; ?>" class="text-center">
                                                                                    <i class="fas fa-play-circle pr-20"></i>
                                                                                </a>
                                                                                <a href="courseContentView.php?view=<?php echo $courseContentRow['course_id']; ?>&course_content_id=<?php echo $courseContentRow['id']; ?>">
                                                                                    <?php echo $courseContentRow['doc_title']; ?>
                                                                                </a>
                                                                            </li>
                                                                <?php
                                                                        }
                                                                    }
                                                                }
                                                                ?>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    <?php }
                                    } ?>
                                </div>
                            <?php } else { ?>
                                <div class="course-video">
                                    <?php
                                    $courseChapterCondition['course_id'] = $_GET['view'];
                                    $courseChapterResponse = getData('course_chapter', $courseChapterCondition);
                                    if ($courseChapterResponse->num_rows > 0) {
                                        while ($row = $courseChapterResponse->fetch_assoc()) {
                                    ?>
                                            <div class="panel-group">
                                                <div class="panel panel-default course-chapter">
                                                    <a class="course-chapter-click" data-toggle="collapse" href="#<?php echo $row['id']; ?>">
                                                        <div class="course-chapter-title">
                                                            <i class="fal fa-chevron-down pr-20"></i>
                                                            <?php echo $row['chapter_title']; ?>
                                                        </div>
                                                    </a>
                                                    <div id="<?php echo $row['id']; ?>" class="panel-collapse collapse">
                                                        <div class="course-chapter-body">
                                                            <ul>
                                                                <?php
                                                                $courseContentCondition['chapter_id'] = $row['id'];
                                                                $courseContentResponse = getData('course_content', $courseContentCondition);
                                                                if ($courseContentResponse->num_rows > 0) {
                                                                    while ($courseContentRow = $courseContentResponse->fetch_assoc()) {
                                                                        if ($courseContentRow['is_trailer'] == "true") {
                                                                            $file_extension = explode(".", $courseContentRow['document_path']);
                                                                            if ($file_extension[1] == "pdf") { ?>
                                                                                <li>
                                                                                    <a href="<?php echo $coursePath . $courseContentRow['document_path']; ?>" target="_blank" class="text-center">
                                                                                        <i class="fas fa-file-pdf pr-20"></i>
                                                                                    </a>
                                                                                    <a href="<?php echo $coursePath . $courseContentRow['document_path']; ?>" target="_blank">
                                                                                        <?php echo $courseContentRow['doc_title']; ?>
                                                                                    </a>
                                                                                </li>
                                                                            <?php } else { ?>
                                                                                <li>
                                                                                    <a href="courseContentView.php?view=<?php echo $courseContentRow['course_id']; ?>&course_content_id=<?php echo $courseContentRow['id']; ?>" class="text-center">
                                                                                        <i class="fas fa-play-circle pr-20"></i>
                                                                                    </a>
                                                                                    <a href="courseContentView.php?view=<?php echo $courseContentRow['course_id']; ?>&course_content_id=<?php echo $courseContentRow['id']; ?>">
                                                                                        <?php echo $courseContentRow['doc_title']; ?>
                                                                                    </a>
                                                                                </li>
                                                                            <?php
                                                                            }
                                                                        } else { ?>
                                                                            <li>
                                                                                <i class="fas fa-play-circle pr-20"></i>
                                                                                <?php echo $courseContentRow['doc_title']; ?>
                                                                            </li>
                                                                <?php }
                                                                    }
                                                                }
                                                                ?>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    <?php }
                                    } ?>
                                </div>
                            <?php } ?>
                        </div>

                        <div class="col-md-12 mt-20">
                            <hr>
                            <div class="course-review">
                                <h4 class="mb-20">Reviews</h4>
                                <?php
                                if (!empty($_SESSION["userId"]) && !empty($_SESSION["userEmail"])) {
                                    $checkCourseExistCondition['user_id'] = $_SESSION["userId"];
                                    $checkCourseExistCondition['course_id'] = $_GET['view'];
                                    $checkCourseExistResponse = getData('user_courses', $checkCourseExistCondition);
                                    $checkCourseExistResponse = $checkCourseExistResponse->fetch_assoc();

                                    $checkReviewCondition['user_id'] = $_SESSION["userId"];
                                    $checkReviewCondition['course_id'] = $_GET['view'];
                                    $checkReviewResponse = getData('course_review', $checkReviewCondition);
                                    $checkReviewResponse = $checkReviewResponse->fetch_assoc();
                                    if (!empty($checkCourseExistResponse) && !empty($checkReviewResponse)) { ?>
                                        <?php
                                        $userCondition['id'] = $checkReviewResponse["user_id"];
                                        $userDataResponse = getData('user', $userCondition);
                                        $userDataResponse = $userDataResponse->fetch_assoc();
                                        ?>
                                        <div id="userReview">
                                            <div class="d-flex flex-row course-reviewlist">
                                                <div class="text-center user-profile pr-4">
                                                    <img src="<?php echo $userProfilePath . $userDataResponse['profile_pic']; ?>" alt="">
                                                </div>
                                                <div class="review-detail">
                                                    <h5><?php echo $userDataResponse['full_name']; ?></h5>
                                                    <div class="course-rating mb-2">
                                                        <h6 class="course-rating-num">(<?php echo $checkReviewResponse['rating']; ?>)</h6>
                                                        <span class="stars"><?php echo $checkReviewResponse['rating']; ?></span>
                                                    </div>
                                                    <h6><?php echo $checkReviewResponse['title']; ?></h6>
                                                    <p style="font-size: 1.1rem; margin-bottom: 5px;"><?php echo $checkReviewResponse['description']; ?></p>

                                                    <?php $reviewId = $checkReviewResponse['id']; ?>
                                                    <a href="javascript:void(0);" id="<?php echo $reviewId ?>" onclick="editReview(this.id);">Edit</a>
                                                </div>
                                            </div>
                                            <hr>
                                        </div>
                                    <?php } else { ?>
                                        <form action="include/UserSubmitData.php" method="POST" class="xs-form">
                                            <input type="hidden" name="module" value="course_reviewAdd">
                                            <input type="hidden" name="moduleMethod" value="course_review">
                                            <input type="hidden" name="course_id" value="<?php echo $_GET['view'] ?>">
                                            <div class="form-group xs-form-anim">
                                                <label class="input-label" for="rating">Rating</label>
                                                <input type="number" id="rating" name="rating" class="form-control">
                                            </div>
                                            <div class="form-group xs-form-anim">
                                                <label class="input-label" for="title">Title</label>
                                                <input type="text" id="title" name="title" class="form-control">
                                            </div>
                                            <div class="form-group xs-form-anim xs-message-box">
                                                <label class="input-label input-label-textarea" for="description">Description</label>
                                                <textarea id="description" name="description" class="form-control"></textarea>
                                            </div>
                                            <div class="form-group mt-30">
                                                <button type="submit" id="reviewSub" name="reviewSub" style="border-radius: 0px; font-size: 17px;" class="pr-3 pl-3 pt-2 pb-2 btn btn-primary">Submit Now</button>
                                            </div>
                                        </form>
                                        <hr>
                                <?php }
                                } ?>

                                <?php
                                $reviewCondition['course_id'] = $_GET['view'];
                                $reviewResponse = getData('course_review', $reviewCondition);
                                if (!empty($reviewResponse)) {
                                    while ($reviewResponseRow = $reviewResponse->fetch_assoc()) {
                                        $userCondition['id'] = $reviewResponseRow["user_id"];
                                        $userDataResponse = getData('user', $userCondition);
                                        $userDataResponse = $userDataResponse->fetch_assoc();
                                        if (!empty($_SESSION["userId"]) && !empty($_SESSION["userEmail"])) {
                                            if ($reviewResponseRow['user_id'] != $_SESSION["userId"]) {
                                ?>
                                                <div class="d-flex flex-row course-reviewlist">
                                                    <div class="text-center user-profile pr-4">
                                                        <img src="<?php echo $userProfilePath . $userDataResponse['profile_pic']; ?>" alt="">
                                                    </div>
                                                    <div class="review-detail">
                                                        <h5><?php echo $userDataResponse['full_name']; ?></h5>
                                                        <div class="course-rating mb-2">
                                                            <h6 class="course-rating-num">(<?php echo $reviewResponseRow['rating']; ?>)</h6>
                                                            <span class="stars"><?php echo $reviewResponseRow['rating']; ?></span>
                                                        </div>
                                                        <h6><?php echo $reviewResponseRow['title']; ?></h6>
                                                        <p style="font-size: 1.1rem;"><?php echo $reviewResponseRow['description']; ?></p>
                                                    </div>
                                                </div>
                                                <hr>
                                            <?php }
                                        } else { ?>
                                            <div class="d-flex flex-row course-reviewlist">
                                                <div class="text-center user-profile pr-4">
                                                    <img src="<?php echo $userProfilePath . $userDataResponse['profile_pic']; ?>" alt="">
                                                </div>
                                                <div class="review-detail">
                                                    <h5><?php echo $userDataResponse['full_name']; ?></h5>
                                                    <div class="course-rating mb-2">
                                                        <h6 class="course-rating-num">(<?php echo $reviewResponseRow['rating']; ?>)</h6>
                                                        <span class="stars"><?php echo $reviewResponseRow['rating']; ?></span>
                                                    </div>
                                                    <h6><?php echo $reviewResponseRow['title']; ?></h6>
                                                    <p style="font-size: 1.1rem;"><?php echo $reviewResponseRow['description']; ?></p>
                                                </div>
                                            </div>
                                            <hr>
                                <?php }
                                    }
                                } ?>
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
        $('.course-chapter-click').click(function() {
            $(this).find('i').toggleClass('fal fa-chevron-down fal fa-chevron-up');
        });
    </script>
</body>

</html>