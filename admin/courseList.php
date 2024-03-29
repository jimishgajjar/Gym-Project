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
                                            <th>Options</th>
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
                                                        <a href="courseView.php?view=<?php echo $row['id'] ?>">
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
                                                    <td><?php echo $response['category_name']; ?></td>
                                                    <td>
                                                        <a href=" course.php?edit=<?php echo $row['id']; ?>" class="btn btn-info btn-sm"><i class="feather icon-edit"></i>&nbsp;Edit </a>
                                                        <a href="include/AdminSubmitData.php?moduleMethod=course&module=courseDelete&delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm"><i class="feather icon-trash-2"></i>&nbsp;Delete </a>
                                                    </td>
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