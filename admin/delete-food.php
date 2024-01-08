<?php

    include('../config/constants.php');

    if(isset($_GET['id']) && isset($_GET['image_name'])) {
        // process to delete
        // 1. get id and image name
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        // 2. remove image if available
        if($image_name != "") {
            // get image path
            $path = "../images/food/".$image_name;
            
            // remove image file from folder
            $remove = unlink($path);

            if($remove == false) {
                $_SESSION['upload'] = "<div class='error'>Failed to remove image file</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
                die();
            }

        }

        // 3. delete food from database
        $sql = "DELETE FROM tbl_food WHERE id=$id";

        $res = mysqli_query($conn, $sql);

        if($res == true) {
            // food deleted
            $_SESSION['delete'] = "<div class='success'>Food deleted successfully.</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        } else {
            // failed to delete food
            $_SESSION['delete'] = "<div class='danger'>Failed to delete food</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }

        // 4. redirect to manage food with session message

        
    } else {
        // redirect to manage food page
        $_SESSION['unathorized'] = "<div class='danger'>Unauthorized access</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }