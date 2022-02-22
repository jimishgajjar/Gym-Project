<?php
include('checkSession.php');
include('header.php');
?>

<body class="">
    <?php include('menu.php'); ?>

    <!-- [ Main Content ] start -->
    <div class="pcoded-main-container">
        <div class="pcoded-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php"><i class="feather icon-home"></i></a>
                                </li>
                                <li class="breadcrumb-item"><a href="#!">User View</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
            <div class="row">
                <!-- [ sample-page ] start -->
                <div class="col-sm-12">
                    <div class="card">
                        <?php if (isset($_GET['view'])) { ?>
                            <div class="card-header">
                                <h5>User View</h5>
                            </div>
                            <div class="card-body">
                                <?php
                                $Condition['id'] = $_GET['view'];
                                $response = getData('user', $Condition);
                                $response = $response->fetch_assoc();
                                if (!empty($response)) {
                                ?>
                                    <div class="form-group row">
                                        <label for="user_name" class="col-sm-2 col-form-label">Full Name :</label>
                                        <div class="col-sm-4">
                                            <input type="text" readonly class="form-control-plaintext" id="user_name" value="<?php echo $response['full_name'] ?>">
                                        </div>

                                        <label for="user_email" class="col-sm-2 col-form-label">Email :</label>
                                        <div class="col-sm-4">
                                            <input type="text" readonly class="form-control-plaintext" id="user_email" value="<?php echo $response['email'] ?>">
                                        </div>

                                        <label for="mobile_no" class="col-sm-2 col-form-label">Mobile No :</label>
                                        <div class="col-sm-4">
                                            <input type="text" readonly class="form-control-plaintext" id="mobile_no" value="<?php echo $response['mobile_no'] ?>">
                                        </div>

                                        <label for="gender" class="col-sm-2 col-form-label">Gender :</label>
                                        <div class="col-sm-4">
                                            <input type="text" readonly class="form-control-plaintext" id="gender" value="<?php echo $response['gender'] ?>">
                                        </div>

                                        <label for="height" class="col-sm-2 col-form-label">Height :</label>
                                        <div class="col-sm-4">
                                            <input type="text" readonly class="form-control-plaintext" id="height" value="<?php echo $response['height'] ?>">
                                        </div>

                                        <label for="weight" class="col-sm-2 col-form-label">Weight :</label>
                                        <div class="col-sm-4">
                                            <input type="text" readonly class="form-control-plaintext" id="weight" value="<?php echo $response['weight'] ?>">
                                        </div>

                                        <label for="weight" class="col-sm-2 col-form-label">User Report :</label>
                                        <div class="col-sm-4">
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#progressReport">
                                                Check Report
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Modal -->
                                    <div class="modal fade" id="progressReport" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header justify-content-center">
                                                    <h5 class="modal-title" id=""><?php echo $response['full_name']; ?> Progress Report</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                                                        <thead>
                                                            <tr>
                                                                <th>Date & Time</th>
                                                                <th>Weight</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $userReportQuery = "SELECT * FROM user_report WHERE user_id = '" . $_GET['view'] . "' ORDER BY date_entered ASC;";
                                                            $userReport = $conn->query($userReportQuery);

                                                            if ($userReport->num_rows > 0) {
                                                                while ($row = $userReport->fetch_assoc()) {
                                                            ?>
                                                                    <tr>
                                                                        <td>
                                                                            <?php
                                                                            $s = $row['date_entered'];
                                                                            $dt = new DateTime($s);

                                                                            echo $dt->format('d/m/Y');
                                                                            ?>
                                                                        </td>
                                                                        <td><?php echo $row['weight']; ?></td>
                                                                    </tr>
                                                                <?php }
                                                            } else { ?>
                                                                <tr>
                                                                    <td colspan="6" align="center">No data avalible.</td>
                                                                </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <h5 class="mt-5">User Courses</h5>

                                    <div class="table-responsive dt-responsive">
                                        <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                                            <thead>
                                                <tr>
                                                    <th>Thumbnail</th>
                                                    <th>Title</th>
                                                    <th>Course Completed</th>
                                                    <th>Amount</th>
                                                    <th>Discounted Amount</th>
                                                    <th>Final Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $userCoursesCondition['user_id'] = $_GET['view'];
                                                $userCourses = getData('user_courses', $userCoursesCondition);
                                                if ($userCourses->num_rows > 0) {
                                                    while ($row = $userCourses->fetch_assoc()) {
                                                        $courseCondition['id'] = $row['course_id'];
                                                        $courseResponse = getData('course', $courseCondition);
                                                        $courseResponse = $courseResponse->fetch_assoc();
                                                ?>
                                                        <tr>
                                                            <td><img class="thumbnail" src="../assets/thumbnail/<?php echo $courseResponse['thumbnail']; ?>" alt="" /></td>
                                                            <td>
                                                                <?php
                                                                if (strlen($courseResponse['title']) >= 50) {
                                                                    echo substr($courseResponse['title'], 0, 50) . "...";
                                                                } else {
                                                                    echo substr($courseResponse['title'], 0, 50);
                                                                }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                $courseCountCondition['course_id']  = $row['course_id'];
                                                                $courseCount = getData('course_content', $courseCountCondition);
                                                                $courseCount = $courseCount->num_rows;
                                                                $coursePercentage = 100 / $courseCount;

                                                                $courseProgressCondition['user_id']  = $_GET['view'];
                                                                $courseProgressCondition['course_id']  = $row['course_id'];
                                                                $courseProgress = getData('course_progress', $courseProgressCondition);
                                                                $courseProgress = $courseProgress->num_rows;
                                                                $userCoursePer = $courseProgress * $coursePercentage;

                                                                echo round($userCoursePer);
                                                                ?>
                                                            </td>
                                                            <td><?php echo $row['course_amount']; ?></td>
                                                            <td><?php echo $row['discount_given']; ?></td>
                                                            <td><?php echo $row['final_amount']; ?></td>
                                                        </tr>
                                                    <?php }
                                                } else { ?>
                                                    <tr>
                                                        <td colspan="6" align="center">No data avalible.</td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php } else { ?>
                                    <div class="col-md-12">
                                        <div class="alert alert-danger" role="alert">
                                            Data not found !
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <!-- [ sample-page ] end -->
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
    <!-- [ Main Content ] end -->

    <?php include('footer.php'); ?>

</body>

</html>