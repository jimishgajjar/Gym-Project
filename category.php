<?php
session_start();
include('header.php');
?>

<body>
    <?php include('menu.php'); ?>

    <section class="xs-section-padding" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="xs-section-heading text-center">
                        <h2><?php echo $_REQUEST['category_name']; ?></h2>
                    </div>
                </div>
            </div>

            <div class="row">
                <?php
                $courseListCondition['category_id'] = $_REQUEST['category'];
                $courseList = getData('course', $courseListCondition);
                if ($courseList->num_rows > 0) {
                    while ($row = $courseList->fetch_assoc()) {
                        $Condition['id'] = $row['category_id'];
                        $response = getData('category', $Condition);
                        $response = $response->fetch_assoc();
                ?>
                        <div class="col-md-3 mb-25">
                            <div class="course">
                                <img class="course-thumbline" src="assets/thumbnail/<?php echo $row['thumbnail']; ?>" alt="course1" />
                                <div class="course-content">
                                    <div class="course-category mb-1">
                                        <?php echo $response['category_name']; ?>
                                    </div>
                                    <div class="course-title mb-1">
                                        <?php
                                        if (strlen($row['title']) >= 85) {
                                            echo substr($row['title'], 0, 85) . "...";
                                        } else {
                                            echo substr($row['title'], 0, 85);
                                        }
                                        ?>
                                    </div>
                                    <div class="course-rating mb-1">
                                        <h6 class="course-rating-num">(<?php echo $row['rating']; ?>)</h6>
                                        <span class="stars"><?php echo $row['rating']; ?></span>
                                    </div>
                                    <a href="courseDetailView.php?view=<?php echo $row['id'] ?>" class="btn btn-primary btn-100">Know More</a>
                                </div>
                            </div>
                        </div>
                <?php }
                } ?>
            </div>
        </div>
    </section>

    <?php include('footer.php'); ?>

</body>

</html>