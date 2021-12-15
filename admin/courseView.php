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
                        <?php if (isset($_GET['view'])) { ?>
                            <div class="card-header">
                                <h5>Course View</h5>
                            </div>
                            <div class="card-body">
                                <?php
                                $Condition['id'] = $_GET['view'];
                                $response = getData('course', $Condition);
                                $response = $response->fetch_assoc();

                                if (!empty($response)) {
                                ?>
                                    <div class="form-group row">
                                        <label for="thumbnail" class="col-sm-2 col-form-label">Thumbnail :</label>
                                        <div class="col-sm-10">
                                            <img src="../assets/thumbnail/<?php echo $response['thumbnail']; ?>" height="100" />
                                        </div>

                                        <label for="title" class="col-sm-2 col-form-label">Title :</label>
                                        <div class="col-sm-4">
                                            <input type="text" readonly class="form-control-plaintext" id="title" value="<?php echo $response['title'] ?>">
                                        </div>

                                        <label for="description" class="col-sm-2 col-form-label">Description :</label>
                                        <div class="col-sm-4">
                                            <input type="text" readonly class="form-control-plaintext" id="description" value="<?php echo $response['description'] ?>">
                                        </div>

                                        <label for="description" class="col-sm-2 col-form-label">Tags :</label>
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