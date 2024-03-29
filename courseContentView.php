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
        <section class="course-detail" style="padding-bottom: 0px;">
            <div class="course-detail-header">
                <div class="container">
                    <!-- <div class="p-5"> -->
                    <div class="row pb-5">
                        <div class="col-md-12 mb-10">
                            <ol class="cd-breadcrumb">
                                <li><a href="index.php">Home</a></li>
                                <li><a href="courseCategory.php"><?php echo $categoryresponse['category_name']; ?></a></li>
                            </ol>
                        </div>
                        <div class="col-md-12">
                            <div class="course-detail-title">
                                <h4><?php echo $response['title']; ?></h4>
                            </div>
                            <div class="course-detail-description">
                                <p>
                                    <?php echo $response['small_description']; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row pb-5">
                        <div class="col-md-8 text-center">
                            <?php
                            $courseVideoCondition['id'] = $_REQUEST['course_content_id'];
                            $courseVideoResponse = getData('course_content', $courseVideoCondition);
                            $courseVideoResponse = $courseVideoResponse->fetch_assoc();

                            if (!empty($_SESSION["userId"]) && !empty($_SESSION["userEmail"])) {
                                $userCoursesCondition['user_id'] = $_SESSION["userId"];
                                $userCoursesCondition['course_id'] = $_REQUEST['view'];
                                $userCoursesResponse = getData('user_courses', $userCoursesCondition);
                                $userCoursesResponse = $userCoursesResponse->fetch_assoc();
                                if (!empty($userCoursesResponse)) {
                            ?>
                                    <video id="courseVideo" autoplay crossorigin playsinline poster="<?php echo $thumbnailPath . $response['thumbnail']; ?>">
                                        <source src="<?php echo $coursePath . $courseVideoResponse['document_path']; ?>" type="video/mp4">
                                    </video>
                                    <input type="hidden" name="course_position" id="course_position" value="<?php echo $courseVideoResponse['position_order']; ?>" />
                                    <input type="hidden" name="course_id" id="course_id" value="<?php echo $courseVideoResponse['course_id']; ?>" />
                                    <input type="hidden" name="content_id" id="content_id" value="<?php echo $courseVideoResponse['id']; ?>" />
                                    <input type="hidden" name="chapter_id" id="chapter_id" value="<?php echo $courseVideoResponse['chapter_id']; ?>" />
                                    <script>
                                        $(document).ready(function() {
                                            setInterval(getvideo, 5000);
                                        });
                                    </script>
                                    <!-- <a href="courseDetailView.php?view=61ae105cb949a" class="mt-4 col-md-4 btn btn-primary btn-100">Upload Your Report</a> -->
                                <?php } else { ?>
                                    // echo "You can not access this video";
                                    <h3 style="color: #fff;">You can not access this video</h3>
                                <?php }
                            } else {
                                if ($courseVideoResponse['is_trailer'] == "true") { ?>
                                    <video id="courseVideo" autoplay crossorigin playsinline poster="<?php echo $thumbnailPath . $response['thumbnail']; ?>">
                                        <source src="<?php echo $coursePath . $courseVideoResponse['document_path']; ?>" type="video/mp4">
                                    </video>
                                    <input type="hidden" name="course_position" id="course_position" value="<?php echo $courseVideoResponse['position_order']; ?>" />
                                    <input type="hidden" name="course_id" id="course_id" value="<?php echo $courseVideoResponse['course_id']; ?>" />
                                    <input type="hidden" name="content_id" id="content_id" value="<?php echo $courseVideoResponse['id']; ?>" />
                                    <input type="hidden" name="chapter_id" id="chapter_id" value="<?php echo $courseVideoResponse['chapter_id']; ?>" />
                                <?php } else { ?>
                                    <h3 style="color: #fff;">You can not access this video</h3>
                                    <a href="#" class="col-md-3 btn btn-primary" style="margin-top: 20px;">
                                        Buy Course Now
                                    </a>
                            <?php }
                            } ?>
                        </div>
                        <div class="col-md-4">
                            <div class="course-video">
                                <?php
                                $courseChapterCondition['course_id'] = $_GET['view'];
                                $courseChapterResponse = getData('course_chapter', $courseChapterCondition);

                                $courseContentConditionNew['id'] = $_GET['course_content_id'];
                                $courseContentResponseNew = getData('course_content', $courseContentConditionNew);
                                $courseContentRowNew = $courseContentResponseNew->fetch_assoc();

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

                                                <?php if ($row['id'] == $courseContentRowNew['chapter_id']) { ?>
                                                    <div id="<?php echo $row['id']; ?>" class="panel-collapse collapse show">
                                                    <?php } else { ?>
                                                        <div id="<?php echo $row['id']; ?>" class="panel-collapse collapse">
                                                        <?php } ?>
                                                        <!-- <div id="<?php echo $row['id']; ?>" class="panel-collapse collapse"> -->
                                                        <div class="course-chapter-body">
                                                            <ul>
                                                                <?php
                                                                $courseContentCondition['chapter_id'] = $row['id'];
                                                                $courseContentResponse = getData('course_content', $courseContentCondition);
                                                                if ($courseContentResponse->num_rows > 0) {
                                                                    while ($courseContentRow = $courseContentResponse->fetch_assoc()) {
                                                                        $file_extension = explode(".", $courseContentRow['document_path']);

                                                                        $CourseProgressCondition['content_id'] = $courseContentRow['id'];
                                                                        $CourseProgressCondition['user_id'] = $_SESSION["userId"];
                                                                        $CourseProgressResponse = getData('course_progress', $CourseProgressCondition);
                                                                        $CourseProgressResponse = $CourseProgressResponse->fetch_assoc();

                                                                        if ($file_extension[1] == "pdf") { ?>
                                                                            <li>
                                                                                <?php
                                                                                if (!empty($userCoursesResponse)) { ?>
                                                                                    <input type="hidden" name="Doc_course_position-<?php echo $courseContentRow['id']; ?>" id="Doc_course_position-<?php echo $courseContentRow['id']; ?>" value="<?php echo $courseContentRow['position_order']; ?>" />
                                                                                    <input type="hidden" name="Doc_course_id-<?php echo $courseContentRow['id']; ?>" id="Doc_course_id-<?php echo $courseContentRow['id']; ?>" value="<?php echo $courseContentRow['course_id']; ?>" />
                                                                                    <input type="hidden" name="Doc_content_id-<?php echo $courseContentRow['id']; ?>" id="Doc_content_id-<?php echo $courseContentRow['id']; ?>" value="<?php echo $courseContentRow['id']; ?>" />
                                                                                    <input type="hidden" name="Doc_chapter_id-<?php echo $courseContentRow['id']; ?>" id="Doc_chapter_id-<?php echo $courseContentRow['id']; ?>" value="<?php echo $courseContentRow['chapter_id']; ?>" />

                                                                                    <a href="courseContentView.php?view=<?php echo $courseContentRow['course_id']; ?>&course_content_id=<?php echo $courseContentRow['id']; ?>">
                                                                                        <div>
                                                                                            <i class="fas fa-file-pdf pr-20" style="padding-left: 2px;"></i>
                                                                                            <div style="padding-left: 2px;">
                                                                                                <?php echo $courseContentRow['doc_title']; ?>
                                                                                            </div>
                                                                                            <?php
                                                                                            if (!empty($CourseProgressResponse)) { ?>
                                                                                                <input type="checkbox" value="<?php echo $courseContentRow['id'] . "_" . $courseContentRow['chapter_id'] . "_" . $courseContentRow['course_id']; ?>" onclick="AddRemoveProgress(this);" checked>
                                                                                            <?php } else { ?>
                                                                                                <input type="checkbox" value="<?php echo $courseContentRow['id'] . "_" . $courseContentRow['chapter_id'] . "_" . $courseContentRow['course_id']; ?>" onclick="AddRemoveProgress(this);">
                                                                                            <?php } ?>
                                                                                        </div>
                                                                                    </a>
                                                                                    <?php } else {
                                                                                    if ($courseContentRow['is_trailer'] == "true") { ?>
                                                                                        <a href="courseContentView.php?view=<?php echo $courseContentRow['course_id']; ?>&course_content_id=<?php echo $courseContentRow['id']; ?>">
                                                                                            <div>
                                                                                                <i class="fas fa-file-pdf pr-20" style="padding-left: 2px;"></i>
                                                                                                <div style="padding-left: 2px;">
                                                                                                    <?php echo $courseContentRow['doc_title']; ?>
                                                                                                </div>
                                                                                            </div>
                                                                                        </a>
                                                                                    <?php } else { ?>
                                                                                        <div>
                                                                                            <i class="fas fa-file-pdf pr-20" style="padding-left: 2px;"></i>
                                                                                            <div style="padding-left: 2px;">
                                                                                                <?php echo $courseContentRow['doc_title']; ?>
                                                                                            </div>
                                                                                        </div>
                                                                                <?php }
                                                                                } ?>
                                                                            </li>
                                                                        <?php } else { ?>
                                                                            <li>
                                                                                <?php
                                                                                if (!empty($userCoursesResponse)) { ?>
                                                                                    <a href="courseContentView.php?view=<?php echo $courseContentRow['course_id']; ?>&course_content_id=<?php echo $courseContentRow['id']; ?>">
                                                                                        <div>
                                                                                            <i class="fas fa-play-circle pr-20"></i>
                                                                                            <div>
                                                                                                <?php echo $courseContentRow['doc_title']; ?>
                                                                                            </div>
                                                                                            <?php
                                                                                            if (!empty($CourseProgressResponse)) { ?>
                                                                                                <input type="checkbox" value="<?php echo $courseContentRow['id'] . "_" . $courseContentRow['chapter_id'] . "_" . $courseContentRow['course_id']; ?>" onclick="AddRemoveProgress(this);" checked>
                                                                                            <?php } else { ?>
                                                                                                <input type="checkbox" value="<?php echo $courseContentRow['id'] . "_" . $courseContentRow['chapter_id'] . "_" . $courseContentRow['course_id']; ?>" onclick="AddRemoveProgress(this);">
                                                                                            <?php } ?>
                                                                                        </div>
                                                                                    </a>
                                                                                    <?php } else {
                                                                                    if ($courseContentRow['is_trailer'] == "true") { ?>
                                                                                        <a href="courseContentView.php?view=<?php echo $courseContentRow['course_id']; ?>&course_content_id=<?php echo $courseContentRow['id']; ?>">
                                                                                            <div>
                                                                                                <i class="fas fa-play-circle pr-20"></i>
                                                                                                <div>
                                                                                                    <?php echo $courseContentRow['doc_title']; ?>
                                                                                                </div>
                                                                                            </div>
                                                                                        </a>
                                                                                    <?php } else { ?>
                                                                                        <div>
                                                                                            <i class="fas fa-play-circle pr-20"></i>
                                                                                            <div>
                                                                                                <?php echo $courseContentRow['doc_title']; ?>
                                                                                            </div>
                                                                                        </div>
                                                                                <?php }
                                                                                } ?>
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