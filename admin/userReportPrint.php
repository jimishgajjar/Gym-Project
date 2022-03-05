<?php
include('checkSession.php');
include('header.php');
?>

<body style="background: #fff;">
    <div class="container">
        <!-- [ Main Content ] start -->
        <div class="row">
            <!-- [ sample-page ] start -->
            <div class="col-md-12 text-center">
                <h3>Course Report</h3>
            </div>
            <div class="col-md-12 mt-5">
                <?php if (isset($_GET['view'])) { ?>
                    <?php
                    $Condition['id'] = $_GET['view'];
                    $response = getData('user', $Condition);
                    $response = $response->fetch_assoc();
                    if (!empty($response)) {
                    ?>
                        <style>
                            .userInfo {
                                width: 100%;
                                border-collapse: collapse;
                                font-size: 18px;
                            }

                            .userInfo,
                            .userInfo td,
                            .userInfo th,
                            .userInfo tr {
                                padding: 5px;
                            }

                            .userInfo tr td {
                                width: 25%;
                            }
                        </style>
                        <table class="userInfo">
                            <tr>
                                <td><b>Full Name :</b></td>
                                <td><?php echo $response['full_name'] ?></td>
                                <td><b>Email :</b></td>
                                <td><?php echo $response['email'] ?></td>
                            </tr>
                            <tr>
                                <td><b>Mobile No :</b></td>
                                <td><?php echo $response['mobile_no'] ?></td>
                                <td><b>Gender :</b></td>
                                <td><?php echo $response['gender'] ?></td>
                            </tr>
                            <tr>
                                <td><b>Height :</b></td>
                                <td><?php echo $response['height'] ?></td>
                                <td><b>Weight :</b></td>
                                <td><?php echo $response['weight'] ?></td>
                            </tr>
                        </table>
                        <style>
                            .printTable {
                                width: 100%;
                                border-collapse: collapse;
                                font-size: 16px;
                            }

                            .printTable,
                            .printTable td,
                            .printTable th,
                            .printTable tr {
                                padding: 5px;
                                border: 1px solid;
                            }
                        </style>
                        <h5 class="mt-5">User Courses</h5>
                        <table id="" class="printTable">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 3%;">#</th>
                                    <th>Title</th>
                                    <th>Course Completed</th>
                                    <th>Amount</th>
                                    <th>Discounted Amount</th>
                                    <th>Final Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $rowCount = 0;
                                $userCoursesCondition['user_id'] = $_GET['view'];
                                $userCourses = getData('user_courses', $userCoursesCondition);
                                if ($userCourses->num_rows > 0) {
                                    while ($row = $userCourses->fetch_assoc()) {
                                        $courseCondition['id'] = $row['course_id'];
                                        $courseResponse = getData('course', $courseCondition);
                                        $courseResponse = $courseResponse->fetch_assoc();
                                        $rowCount++;
                                ?>
                                        <tr>
                                            <td class="text-center"><?php echo $rowCount ?></td>
                                            <td>
                                                <?php
                                                echo $courseResponse['title'];
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
                    <?php } else { ?>
                        <div class="col-md-12">
                            <div class="alert alert-danger" role="alert">
                                Data not found !
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
            <!-- [ sample-page ] end -->
        </div>
        <!-- [ Main Content ] end -->
    </div>
    <?php include('footer.php'); ?>
    <script>
        window.print();
    </script>
</body>

</html>