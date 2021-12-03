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
                                <?php if (isset($_GET['edit'])) { ?>
                                    <li class="breadcrumb-item"><a href="#!">Category Edit</a></li>
                                <?php } else { ?>
                                    <li class="breadcrumb-item"><a href="#!">Category Add</a></li>
                                <?php } ?>
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
                                <h5>Category Edit</h5>
                            </div>
                            <div class="card-body">
                                <?php
                                $Condition['id'] = $_GET['edit'];
                                $response = getData('category', $Condition);
                                $response = $response->fetch_assoc();
                                ?>
                                <form action="include/AdminSubmitData.php" method="POST">
                                    <input type="hidden" name="module" value="categoryEdit">
                                    <input type="hidden" name="moduleMethod" value="category">
                                    <input type="hidden" name="category_id" value="<?php echo $_GET['edit']; ?>">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="category_name">Category Name</label>
                                            <input type="text" class="form-control" value="<?php echo $response['category_name'] ?>" name="category_name" id="category_name" placeholder="Category Name" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="category_description">Category Description</label>
                                            <input type="text" class="form-control" value="<?php echo $response['category_description'] ?>" name="category_description" id="category_description" placeholder="Category Description" required>
                                        </div>
                                    </div>
                                    <button type="submit" name="categorySub" value="categorySub" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        <?php } else { ?>
                            <div class="card-header">
                                <h5>Category Add</h5>
                            </div>
                            <div class="card-body">
                                <form action="include/AdminSubmitData.php" method="POST">
                                    <input type="hidden" name="module" value="categoryAdd">
                                    <input type="hidden" name="moduleMethod" value="category">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="category_name">Category Name</label>
                                            <input type="text" class="form-control" name="category_name" id="category_name" placeholder="Category Name" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="category_description">Category Description</label>
                                            <input type="text" class="form-control" name="category_description" id="category_description" placeholder="Category Description" required>
                                        </div>
                                    </div>
                                    <button type="submit" name="categorySub" value="categorySub" class="btn btn-primary">Submit</button>
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

</body>

</html>