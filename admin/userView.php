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
                                <li class="breadcrumb-item"><a href="#!">User View</a></li>
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
                                <h5>User View</h5>
                            </div>
                            <div class="card-body">
                                <?php
                                $Condition['id'] = $_GET['view'];
                                $response = getData('user', $Condition);
                                $response = $response->fetch_assoc();
                                ?>
                                <div class="form-group row">
                                    <label for="user_name" class="col-sm-2 col-form-label">Full Name :</label>
                                    <div class="col-sm-10">
                                        <input type="text" readonly class="form-control-plaintext" id="user_name" value="<?php echo $response['full_name'] ?>">
                                    </div>

                                    <label for="user_email" class="col-sm-2 col-form-label">Email :</label>
                                    <div class="col-sm-4">
                                        <input type="text" readonly class="form-control-plaintext" id="user_email" value="<?php echo $response['email'] ?>">
                                    </div>
                                </div>
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