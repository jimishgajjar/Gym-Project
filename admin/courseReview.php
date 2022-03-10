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
                                <li class="breadcrumb-item"><a href="#!">Course Review</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
            <div class="row">
                <!-- [ sample-page ] start -->
                <?php if (isset($_GET['view'])) {
                    $Condition['id'] = $_GET['view'];
                    $response = getData('course', $Condition);
                    $response = $response->fetch_assoc();
                    if (!empty($response)) {
                ?>
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Course Detail</h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="thumbnail" class="col-sm-2 col-form-label">Thumbnail :</label>
                                        <div class="col-sm-10">
                                            <img src="../assets/thumbnail/<?php echo $response['thumbnail']; ?>" height="100" />
                                        </div>

                                        <label for="title" class="col-sm-2 col-form-label">Title :</label>
                                        <div class="col-sm-4">
                                            <input type="text" readonly class="form-control-plaintext" id="title" value="<?php echo $response['title'] ?>">
                                        </div>

                                        <label for="small_description" class="col-sm-2 col-form-label">Small Description :</label>
                                        <div class="col-sm-4">
                                            <p class="form-control-plaintext"><?php echo $response['small_description'] ?></p>
                                        </div>

                                        <label for="tags" class="col-sm-2 col-form-label">Tags :</label>
                                        <div class="col-sm-4 align-middle">
                                            <div class="tag">
                                                <?php
                                                $tags = explode(",", $response['tags']);
                                                foreach ($tags as $tag) {
                                                ?>
                                                    <span class="badge badge-success"><?php echo $tag; ?></span>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php }
                } ?>
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Course Review List</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive dt-responsive">
                                <table id="dom-jqry" class="dom-jqry table table-striped table-bordered nowrap">
                                    <thead>
                                        <tr>
                                            <th>User Name</th>
                                            <th>Title</th>
                                            <th>Rating</th>
                                            <th>Description</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $CourseReviewCondition['course_id'] = $_REQUEST['view'];
                                        $courseReviewList = getData('course_review', $CourseReviewCondition);
                                        if ($courseReviewList->num_rows > 0) {
                                            while ($row = $courseReviewList->fetch_assoc()) {
                                                $Condition['id'] = $row['user_id'];
                                                $response = getData('user', $Condition);
                                                $response = $response->fetch_assoc();
                                        ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $response['full_name']; ?>
                                                    </td>
                                                    <td>
                                                        <a href="javascript:void(0);" data-toggle="modal" data-target="#ReviewModal" id="<?php echo $response['full_name']; ?>~<?php echo $row['rating']; ?>~<?php echo $row['title']; ?>~<?php echo $row['description']; ?>" onclick="openReview(this.id)">
                                                            <?php
                                                            if (strlen($row['title']) >= 50) {
                                                                echo substr($row['title'], 0, 50) . "...";
                                                            } else {
                                                                echo substr($row['title'], 0, 50);
                                                            }
                                                            ?>
                                                        </a>
                                                    </td>
                                                    <td><?php echo $row['rating']; ?>/5</td>
                                                    <td>
                                                        <?php
                                                        if (strlen($row['description']) >= 50) {
                                                            echo substr($row['description'], 0, 50) . "...";
                                                        } else {
                                                            echo substr($row['description'], 0, 50);
                                                        }
                                                        ?>
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
                                <!-- Modal -->
                                <div class="modal fade" id="ReviewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header justify-content-center">
                                                <h5 class="modal-title" id="">Review</h5>
                                            </div>
                                            <div class="modal-body" id="review-modal-body">

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


    <script>
        function openReview(idval) {
            var idval = idval.split("~");

            var full_name = idval[0];
            var rating = idval[1];
            var title = idval[2];
            var description = idval[3];

            $("#review-modal-body").empty();
            $("#review-modal-body").append(
                '<div class="form-group row">' +
                '<label for="user_name" class="col-sm-2 col-form-label">User Name :</label>' +
                '<div class="col-sm-4">' +
                '<input type="text" id="user_name" readonly class="form-control-plaintext" value="' + full_name + '">' +
                '</div>' +

                '<label for="title" class="col-sm-2 col-form-label">Title :</label>' +
                '<div class="col-sm-4">' +
                '<input type="text" id="title" readonly class="form-control-plaintext" value="' + title + '">' +
                '</div>' +

                '<label for="rating" class="col-sm-2 col-form-label">Rating :</label>' +
                '<div class="col-sm-4">' +
                '<input type="text" id="rating" readonly class="form-control-plaintext" value="' + rating + '/5">' +
                '</div>' +

                '<label for="description" class="col-sm-2 col-form-label">Description :</label>' +
                '<div class="col-sm-4">' +
                '<p>' + description + '</p>' +
                '</div>' +
                '</div>'
            );
        }
    </script>
    <?php include('footer.php'); ?>
</body>

</html>