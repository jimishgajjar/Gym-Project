<?php
include('checkSession.php');
include('header.php');
?>

<body class="">
    <?php include('menu.php'); ?>

    <!-- Category Not Delete Modal -->
    <div class="modal fade" id="categoryErrorMessage" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> -->

                    <div class="text-center">
                        <div id="categoryErrorMsg">

                        </div>

                        <div class="mt-5">
                            <button type="button" class="btn  btn-primary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Category List</a></li>
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
                            <h5>Category List</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive dt-responsive" id="categoryList">
                                <table id="dom-jqry" class="dom-jqry table table-striped table-bordered nowrap">
                                    <thead>
                                        <tr>
                                            <th>Category Img</th>
                                            <th>Category</th>
                                            <th>Description</th>
                                            <th>Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $categoryList = getData('category');
                                        if ($categoryList->num_rows > 0) {
                                            while ($row = $categoryList->fetch_assoc()) {
                                        ?>
                                                <tr>
                                                    <td>
                                                        <a href="categoryView.php?view=<?php echo $row['id'] ?>">
                                                            <img class="thumbnail" src="../assets/category/<?php echo $row['category_img']; ?>" alt="" />
                                                        </a>
                                                    </td>
                                                    <td><a href="categoryView.php?view=<?php echo $row['id'] ?>"><?php echo $row['category_name'] ?></a></td>
                                                    <td><?php echo $row['category_description'] ?></td>
                                                    <td>
                                                        <a href="category.php?edit=<?php echo $row['id']; ?>" class="btn btn-info btn-sm"><i class="feather icon-edit"></i>&nbsp;Edit </a>
                                                        <!-- include/AdminSubmitData.php?moduleMethod=category&module=categoryDelete&delete=<?php echo $row['id']; ?> -->
                                                        <a href="javascript:void(0);" onclick="deleteCategory(this.id)" id="<?php echo $row['id']; ?>" class="btn btn-danger btn-sm"><i class="feather icon-trash-2"></i>&nbsp;Delete </a>
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