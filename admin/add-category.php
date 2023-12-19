<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br><br>

        <?php
            if(isset($_SESSION['add'])) {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['upload'])) {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

        <br>

        <!-- Add category from starts -->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">
                    </td>
                </tr>
                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" placeholder="Yes"> Yes
                        <input type="radio" name="featured" placeholder="No"> No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <!-- Add category from ends -->

        <?php
        if (isset($_POST['submit'])) {
            // 1. get the value from category form
            $title = $_POST['title'];

            if(isset($_POST['featured'])) {
                $featured = $_POST['featured'];
            } else {
                $featured = "No";
            }

            if(isset($_POST['active'])) {
                $active = $_POST['active'];
            } else {
                $active = "No";
            }

            // check whether image is selected or not
            // print_r($_FILES['image']);
            // die();

            if(isset($_FILES['image']['name'])) {
                // upload the image

                // to upload image we need image name, source path and destination path
                $image_name = $_FILES['image']['name'];
                $ext = end(explode('.', $image_name));

                $image_name = "Food_Category_".rand(000, 999).'.'.$ext; //eg.Food_Category_835.jpg

                $source_path = $_FILES['image']['tmp_name'];
                $destination_path = "../images/category/".$image_name;

                // finally upload image
                $upload = move_uploaded_file($source_path, $destination_path);

                if($upload==false) {
                    $_SESSION['upload'] = "<div class='error'>Failed to upload image</div>";
                    header('location:'.SITEURL.'admin/add-category.php');
                }
            } else {
                // don't upload image and set the image name value as blank
                $image_name = "";
            }

            // 2. create sql query to insert category into database
            $sql = "INSERT INTO tbl_category SET
                title='$title',
                image_name='$image_name',
                featured='$featured',
                active='$active'
            ";

            // 3. execute the query and save in database
            $res = mysqli_query($conn, $sql);

            // 4. check whether the query executed or not and data added or not
            if($res==true) {
                $_SESSION['add'] = "<div class='success'>Category Added Successfully</div>";
                header('location:'.SITEURL.'admin/manage-category.php');
            } else {
                $_SESSION['add'] = "<div class='success'>Failed to add category</div>";
                header('location:'.SITEURL.'admin/manage-category.php');
            }
        }

        ?>
    </div>
</div>



<?php include('partials/footer.php') ?>