<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Category</h1>
        <br /><br />

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>
        <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn btn-primary">Add Category</a>
        <table class="tbl-full">
            <thead>
                <tr>
                    <th>S.N.</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <?php
            // query to get all categories from database
            $sql = "SELECT * FROM tbl_category";

            // execute query
            $res = mysqli_query($conn, $sql);

            $sn = 1;

            // count rows
            $count = mysqli_num_rows($res);

            // check whether we have data in database
            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
            ?>
                    <tr>
                        <td><?php echo $sn++ ?></td>
                        <td><?php echo $title ?></td>
                        <td>
                            <?php 
                            if($image_name!=""){
                                ?>
                                <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name; ?>" alt="" width="100px">
                                <?php
                            } else {
                                echo "<div class='danger'>Image not added</div>";
                            }
                            ?>
                        </td>
                        <td><?php echo $featured ?></td>
                        <td><?php echo $active ?></td>
                        <td>
                            <a href="#" class="btn btn-secondary">Update</a>
                            <a href="#" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php
                }
            } else {
                ?>
                <tr>
                    <td>
                        <div colspan="6" class="danger">No category added</div>
                    </td>
                </tr>
            <?php
            }
            ?>

        </table>
    </div>
</div>

<?php include('partials/footer.php') ?>