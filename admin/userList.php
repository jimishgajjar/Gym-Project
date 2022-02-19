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
                                <li class="breadcrumb-item"><a href="#!">User List</a></li>
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
                            <h5>User List</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive dt-responsive">
                                <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <!-- <th>Options</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $userList = getData('user');
                                        if ($userList->num_rows > 0) {
                                            while ($row = $userList->fetch_assoc()) {
                                        ?>
                                                <tr>
                                                    <td><a href="userView.php?view=<?php echo $row['id'] ?>"><?php echo $row['full_name'] ?></a></td>
                                                    <td><?php echo $row['email'] ?></td>
                                                    <!-- <td>
                                                        <a href="category.php?edit=<?php echo $row['id']; ?>" class="btn btn-info btn-sm"><i class="feather icon-edit"></i>&nbsp;Edit </a>
                                                        <a href="include/AdminSubmitData.php?moduleMethod=category&module=categoryDelete&delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm"><i class="feather icon-trash-2"></i>&nbsp;Delete </a>
                                                    </td> -->
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