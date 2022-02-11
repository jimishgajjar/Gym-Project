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
                        <div class="col-md-8">
                            <?php
                            $courseVideoCondition['id'] = $_REQUEST['course_content_id'];
                            $courseVideoResponse = getData('course_content', $courseVideoCondition);
                            $courseVideoResponse = $courseVideoResponse->fetch_assoc();
                            ?>
                            <video autoplay crossorigin playsinline poster="<?php echo $thumbnailPath . $response['thumbnail']; ?>">
                                <source src="<?php echo $coursePath . $courseVideoResponse['document_path']; ?>" type="video/mp4">
                            </video>
                        </div>
                        <div class="col-md-4">
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
                                                            ?>
                                                                    <li>
                                                                        <a href="courseContentView.php?view=<?php echo $courseContentRow['course_id']; ?>&course_content_id=<?php echo $courseContentRow['id']; ?>">
                                                                            <i class="fas fa-play-circle pr-20"></i>
                                                                            <?php echo $courseContentRow['doc_title']; ?>
                                                                        </a>
                                                                    </li>
                                                            <?php
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