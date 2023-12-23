<?php
    include('../config/constants.php');

    // check whether the id and image_name value is set or not
    if(isset($_GET['id']) &&  isset($_GET['image_name'])) {
        // get the value and delete
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        // remove the physical image file is availabel
        if($image_name != "") {
            $path = "../images/category/".$image_name;

            // remove the image
            $remove = unlink($path);

            // if failed to remove image then add an error message and stop the process
            if($remove==false) {
                // set the session message
                $_SESSION['remove'] = "<div class='error'>Failed to remove category image</div>";

                header('location:'.SITEURL.'admin/manage-category.php');

                die();
            }
        }
        // delete data from database
        $sql = "DELETE FROM tbl_category WHERE id=$id";

        // execute the query
        $res = mysqli_query($conn, $sql);

        // check whether the data is delete from database or not
        if($res == true) {
            // SET sueecss message and redirect
            $_SESSION['delete'] = "<div class='success'>Category deleted successfully</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        } else {
            // set fail message and redirect
            $_SESSION['delete'] = "<div class='danger'>Failed to delete category</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }

    } else {
        // redirect to manage category page
        header('location:'.SITEURL.'admin/manage-category.php');
    }

?>