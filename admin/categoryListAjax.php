<?php
include "../include/dbConfig.php";
include "../include/queryFunction.php";
?>

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