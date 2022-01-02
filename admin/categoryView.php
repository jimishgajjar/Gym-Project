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
                                <li class="breadcrumb-item"><a href="#!">Category Add</a></li>
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
                                <h5>Category View</h5>
                            </div>
                            <div class="card-body">
                                <?php
                                $Condition['id'] = $_GET['view'];
                                $response = getData('category', $Condition);
                                $response = $response->fetch_assoc();

                                if (!empty($response)) {
                                ?>
                                    <div class="form-group row">
                                        <label for="category_name" class="col-sm-2 col-form-label">Category Name :</label>
                                        <div class="col-sm-4">
                                            <input type="text" readonly class="form-control-plaintext" id="category_name" value="<?php echo $response['category_name'] ?>">
                                        </div>

                                        <label for="category_description" class="col-sm-2 col-form-label">Category Description :</label>
                                        <div class="col-sm-4">
                                            <input type="text" readonly class="form-control-plaintext" id="category_description" value="<?php echo $response['category_description'] ?>">
                                        </div>

                                        <label for="category_img" class="col-sm-2 col-form-label">Category Image :</label>
                                        <div class="col-sm-10">
                                            <img src="../assets/category/<?php echo $response['category_img']; ?>" height="100" style="border-radius: 10px;" />
                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="alert alert-danger" role="alert">
                                                Data not found !
                                            </div>
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