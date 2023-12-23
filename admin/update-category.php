<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>

        <br>

        <?php
        if (isset($_GET['id'])) {
            // get id ad all other details
            $id = $_GET['id'];

            $sql = "SELECT * FROM tbl_category WHERE id=$id";

            $data = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($data);

            if ($count == 1) {
                $row = mysqli_fetch_assoc($data);
                $title = $row['title'];
                $current_image = $row['image_name'];
                $featured = $row['featured'];
                $active = $row['active'];
            } else {
                $_SESSION['no-category'] = "<div class='danger'>Category not foudn</div>";
                header('location:' . SITEURL . "admin/manage-category.php");
            }
        } else {
            header('location:' . SITEURL . "admin/manage-category.php");
        }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php
                        if ($current_image != "") {
                        ?>
                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image ?>" alt="" width="100px">
                        <?php
                        } else {
                            echo "<div class='error'>Image not added</div>";
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input <?php if ($featured == "Yes") {
                                    echo "checked";
                                } ?> type="radio" name="featured" value="Yes"> Yes
                        <input <?php if ($featured == "No") {
                                    echo "checked";
                                } ?> type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td>
                        <input <?php if ($active == "Yes") {
                                    echo "checked";
                                } ?> type="radio" name="active" value="Yes"> Yes
                        <input <?php if ($active == "No") {
                                    echo "checked";
                                } ?> type="radio" name="active" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>
        <?php
        if (isset($_POST['submit'])) {
            // get value
            $id = $_POST['id'];
            $title = $_POST['title'];
            $current_image = $_POST['current_image'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];

            // update new image
            if (isset($_FILE['image']['name'])) {
                // get image details
                $image_name = $_FILES['image']['name'];

                // check image is available or not
                if ($image_name != "") {
                    // image available
                    $ext = end(explode('.', $image_name));

                    $image_name = "Food_Category_" . rand(000, 999) . '.' . $ext; //eg.Food_Category_835.jpg               

                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../images/category/" . $image_name;

                    // finally upload image
                    $upload = move_uploaded_file($source_path, $destination_path);

                    if ($upload == false) {
                        $_SESSION['upload'] = "<div class='error'>Failed to upload image</div>";
                        header('location:' . SITEURL . 'admin/add-category.php');
                        die();
                    }

                    // remove current image
                    if ($current_image != "") {
                        $remove_path = "../images/category/" . $current_image;
                        $remove = unlink($remove_path);

                        // check whether image is removed or not
                        // if failed to remove , display message and stop process
                        if ($remove == false) {
                            $_SESSION['failed-remove'] = "<div class='danger'>Failed to remove current image</div>";
                            header('location:' . SITEURL . 'admin/manage-category.php');
                            die();
                        }
                    }
                } else {
                    $image_name = $current_image;
                }
            } else {
                $image_name = $current_image;
            }

            // update database
            $sql2 = "UPDATE tbl_category SET 
                    title='$title',
                    image_name='$image_name',
                    featured='$featured',
                    active='$active'
                    WHERE id=$id
                ";
            // execute query
            $data2 = mysqli_query($conn, $sql2);

            // redirect
            if ($data2 == true) {
                $_SESSION['update'] = "<div class='success'>Category update successfully</div>";
                header('location:' . SITEURL . 'admin/manage-category.php');
            } else {
                $_SESSION['update'] = "<div class='danger'>Failed to update</div>";
                header('location:' . SITEURL . 'admin/manage-category.php');
            }
        }

        ?>
    </div>
</div>

<?php include('partials/footer.php') ?>