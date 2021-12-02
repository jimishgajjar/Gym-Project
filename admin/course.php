<?php include('header.php'); ?>

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
                                <li class="breadcrumb-item"><a href="#!">Add Course</a></li>
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
                        <?php if (isset($_GET['edit'])) { ?>
                            <div class="card-header">
                                <h5>Course Edit</h5>
                            </div>
                            <div class="card-body">
                                <?php
                                $Condition['id'] = $_GET['edit'];
                                $response = getData('course', $Condition);
                                $response = $response->fetch_assoc();
                                ?>
                                <form action="include/AdminSubmitData.php" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="module" value="courseEdit">
                                    <input type="hidden" name="moduleMethod" value="course">
                                    <input type="hidden" name="course_id" value="<?php echo $response['id']; ?>">
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="title">Title (required)</label>
                                            <input type="text" class="form-control" value="<?php echo $response['title']; ?>" name="title" id="title" placeholder="Course title" required>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="description">Course Description</label>
                                            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Course description" required><?php echo $response['description']; ?></textarea>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="category_id">Select Category</label>
                                            <select class="js-example-basic-single form-control" id="category_id" name="category_id">
                                                <?php
                                                $categoryList = getData("category");
                                                if ($categoryList->num_rows > 0) {
                                                    while ($row = $categoryList->fetch_assoc()) { ?>
                                                        <?php if ($row['id'] == $response['category_id']) { ?>
                                                            <option value="<?php echo $row['id']; ?>" selected><?php echo $row['category_name']; ?></option>
                                                        <?php } else { ?>
                                                            <option value="<?php echo $row['id']; ?>"><?php echo $row['category_name']; ?></option>
                                                        <?php } ?>
                                                <?php }
                                                } ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <?php
                                            $tags = explode(",", $response['tags']);
                                            ?>
                                            <label for="tags">Course Tags</label>
                                            <select multiple data-role="tagsinput" id="tags" name="tags[]">
                                                <?php foreach ($tags as $tag) { ?>
                                                    <option value="<?php echo $tag; ?>"><?php echo $tag; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="thumbnail">Course Thumbnail</label><br>
                                            <img class="thumbnail" id="thumbnail_view" src="../thumbnail/<?php echo $response['thumbnail'] ?>" alt="" />
                                            <input type="file" class="form-control" id="thumbnail" name="thumbnail" accept="image/png, image/jpeg" />
                                        </div>
                                    </div>
                                    <button type="submit" name="courseub" value="courseub" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        <?php } else { ?>
                            <div class="card-header">
                                <h5>Course Add</h5>
                            </div>
                            <div class="card-body">
                                <form action="include/AdminSubmitData.php" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="module" value="courseAdd">
                                    <input type="hidden" name="moduleMethod" value="course">
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="title">Title (required)</label>
                                            <input type="text" class="form-control" name="title" id="title" placeholder="Course title" value="" required>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="description">Course Description</label>
                                            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Course description" required></textarea>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <?php
                                            $categoryList = getData("category");
                                            ?>
                                            <label for="category_id">Select Category</label>
                                            <select class="js-example-basic-single form-control" id="category_id" name="category_id">
                                                <?php if ($categoryList->num_rows > 0) {
                                                    while ($row = $categoryList->fetch_assoc()) { ?>
                                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['category_name']; ?></option>
                                                <?php }
                                                } ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="tags">Course Tags</label>
                                            <select multiple data-role="tagsinput" id="tags" name="tags[]">
                                            </select>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="thumbnail">Course Thumbnail</label>
                                            <input type="file" class="form-control" id="thumbnail" name="thumbnail" accept="image/png, image/jpeg" />
                                        </div>
                                    </div>
                                    <button type="submit" name="courseub" value="courseub" class="btn btn-primary">Submit</button>
                                </form>
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
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#thumbnail_view').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#thumbnail").change(function() {
            readURL(this);
        });
    </script>
</body>

</html>