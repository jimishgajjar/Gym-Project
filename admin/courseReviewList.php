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
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Course List</a></li>
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
                        <div class="card-header">
                            <h5>Course List</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive dt-responsive">
                                <table id="dom-jqry" class="dom-jqry table table-striped table-bordered nowrap">
                                    <thead>
                                        <tr>
                                            <th>Thumbnail</th>
                                            <th>Title</th>
                                            <th>Small Description</th>
                                            <th>Category</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $courseList = getData('course');
                                        if ($courseList->num_rows > 0) {
                                            while ($row = $courseList->fetch_assoc()) {
                                                $Condition['id'] = $row['category_id'];
                                                $response = getData('category', $Condition);
                                                $response = $response->fetch_assoc();
                                        ?>
                                                <tr>
                                                    <td><img class="thumbnail" src="../assets/thumbnail/<?php echo $row['thumbnail']; ?>" alt="" /></td>
                                                    <td>
                                                        <a href="courseReview.php?view=<?php echo $row['id'] ?>">
                                                            <?php
                                                            if (strlen($row['title']) >= 50) {
                                                                echo substr($row['title'], 0, 50) . "...";
                                                            } else {
                                                                echo substr($row['title'], 0, 50);
                                                            }
                                                            ?>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if (strlen($row['small_description']) >= 50) {
                                                            echo substr($row['small_description'], 0, 50) . "...";
                                                        } else {
                                                            echo substr($row['small_description'], 0, 50);
                                                        }
                                                        ?>
                                                    </td>
                                                    <td><?php echo $response['category_name']; ?></td>
                                                </tr>
                                            <?php
                                            }
                                        } else { ?>
                                            <tr>
                                                <td colspan="6" align="center">No data avalible.</td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>

                                <!-- Modal -->
                                <div class="modal fade" id="progressReport" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header justify-content-center">
                                                <h5 class="modal-title" id=""><?php echo $response['full_name']; ?> Progress Report</h5>
                                            </div>
                                            <div class="modal-body">
                                                <table id="dom-jqry" class="dom-jqry table table-striped table-bordered nowrap">
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
                            </div>
                        </div>
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