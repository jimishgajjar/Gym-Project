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
                <?php if (isset($_GET['view'])) {
                    $Condition['id'] = $_GET['view'];
                    $response = getData('course', $Condition);
                    $response = $response->fetch_assoc();
                    if (!empty($response)) {
                ?>
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Course View</h5>
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

                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Course Chapter List</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-2">
                                        <div class="col-md-12">
                                            <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Chapter Title</th>
                                                        <th>Options</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="row_position">
                                                    <?php
                                                    $rowCount = 1;
                                                    $CourseContentCondition['course_id'] = $_GET['view'];
                                                    $CourseContentResponse = getData('course_chapter', $CourseContentCondition);
                                                    if ($CourseContentResponse->num_rows > 0) {
                                                        while ($row = $CourseContentResponse->fetch_assoc()) {
                                                    ?>
                                                            <tr>
                                                                <td><?php echo $rowCount; ?></td>
                                                                <td><?php echo $row['chapter_title'] ?></td>
                                                                <td>
                                                                    <a href="courseContentEdit.php?edit=<?php echo $row['id']; ?>" class="btn btn-info btn-sm"><i class="feather icon-edit"></i>&nbsp;Edit </a>
                                                                    <a href="include/AdminSubmitData.php?moduleMethod=course_chapter&module=courseChapterDelete&delete=<?php echo $row['id']; ?>&course_id=<?php echo $_GET['view']; ?>" class="btn btn-danger btn-sm"><i class="feather icon-trash-2"></i>&nbsp;Delete</a>
                                                                </td>
                                                            </tr>
                                                    <?php
                                                            $rowCount++;
                                                        }
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Add Course Content</h5>
                                </div>
                                <div class="card-body">
                                    <form action="include/AdminSubmitData.php" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="module" value="courseUpload">
                                        <input type="hidden" name="moduleMethod" value="course_chapter">
                                        <input type="hidden" name="course_id" value="<?php echo $response['id']; ?>">

                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="chapter_title">Main Chapter Title (required)</label>
                                                <input type="text" class="form-control" name="chapter_title" id="chapter_title" placeholder="Course Title" value="" required>
                                                <input type="hidden" name="course_content_count" id="course_content_count" value="1">
                                            </div>
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
                                </div>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Course View</h5>
                                </div>
                                <div class="card-body">
                                    <div class="alert alert-danger" role="alert">
                                        Data not found !
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>
                <!-- [ sample-page ] end -->
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
    <!-- [ Main Content ] end -->

    <?php include('footer.php'); ?>
</body>

</html>