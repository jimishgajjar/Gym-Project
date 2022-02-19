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
                                <li class="breadcrumb-item"><a href="#!">Course View</a></li>
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
                            <h5>Add Content In Chapter</h5>
                        </div>
                        <div class="card-body">
                            <?php
                            $Condition['id'] = $_GET['edit'];
                            $response = getData('course_chapter', $Condition);
                            $response = $response->fetch_assoc();
                            if (!empty($response)) {
                            ?>
                                <form action="include/AdminSubmitData.php" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="module" value="courseUpload">
                                    <input type="hidden" name="moduleMethod" value="course_chapter">
                                    <input type="hidden" name="chapter_id" value="<?php echo $_GET['edit']; ?>">
                                    <input type="hidden" name="course_id" value="<?php echo $response['course_id']; ?>">

                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="chapter_title">Main Chapter Title (required)</label>
                                            <input type="text" class="form-control" name="chapter_title" id="chapter_title" placeholder="Course Title" value="<?php echo $response['chapter_title']; ?>" required>
                                            <input type="hidden" name="course_content_count" id="course_content_count" value="1">
                                        </div>
                                    </div>

                                    <div id="content_list">
                                        <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                                            <thead>
                                                <tr>
                                                    <th>Course Title</th>
                                                    <th>Course Path</th>
                                                    <th>Options</th>
                                                    <th>Is Trailer</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $CourseContentCondition['chapter_id'] = $response['id'];
                                                $CourseContentResponse = getData('course_content', $CourseContentCondition);
                                                if ($CourseContentResponse->num_rows > 0) {
                                                    while ($row = $CourseContentResponse->fetch_assoc()) {
                                                ?>
                                                        <tr>
                                                            <td><?php echo $row['doc_title'] ?></td>
                                                            <td></td>
                                                            <td>
                                                                <a href="include/AdminSubmitData.php?moduleMethod=course_content&module=courseContentDelete&delete=<?php echo $row['id']; ?>&chapter_id=<?php echo $response['id']; ?>" class="btn btn-danger btn-sm"><i class="feather icon-trash-2"></i>&nbsp;Delete</a>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                if ($row['is_trailer'] == "true") { ?>
                                                                    <input type="checkbox" id="<?php echo $row['id'] . "_" . $row['chapter_id']; ?>" onchange="is_trailer(this.id)" checked>
                                                                <?php } else { ?>
                                                                    <input type="checkbox" id="<?php echo $row['id'] . "_" . $row['chapter_id']; ?>" onchange="is_trailer(this.id)">
                                                                <?php } ?>
                                                            </td>
                                                        </tr>
                                                <?php }
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="row mt-5 mb-2">
                                        <div class="col-md-12">
                                            <h5>Upload Multiple Video Course</h5>
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <div class="col-md-12 text-center">
                                            <a id="addContentRow" style="color: #fff;" class="btn btn-primary"><i class="fas fa-plus"></i></a>
                                            <a id="deleteContentRow" style="color: #fff;" class="btn btn-primary"><i class="fas fa-minus"></i></a>
                                        </div>
                                    </div>

                                    <div id="course_content">
                                        <div class="row" id="content-0">
                                            <div class="col-md-6 form-group">
                                                <label for="doc_title-0">Document Title</label>
                                                <input type="text" class="form-control" name="doc_title-0" id="doc_title-0" placeholder="Document Title" value="" required>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="upload_doc-0">Upload Video & Files</label>
                                                <input type="file" class="form-control" name="upload_doc-0" id="upload_doc-0" placeholder="Upload Video & Files" value="" required>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" name="courseUploadSub" class="btn btn-primary">Submit</button>
                                </form>
                            <?php } ?>
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