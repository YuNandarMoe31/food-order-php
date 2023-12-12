<?php

    // include constants.php file here
    include('../config/constants.php');

    // get id of admin to delete
    $id = $_GET['id'];

    // create sql query to delete admin
    $sql = "DELETE FROM tbl_admin WHERE id=$id";

    // execute the query
    $data = mysqli_query($conn, $sql);

    // check whether the query executed successfully or not
    if($data == TRUE) {
        // query executed successfully and admin deleted
        $_SESSION['delete'] = "<div class='success'>Admin deleted successfully</div>";

        header('location:'.SITEURL.'admin/manage-admin.php');
    } else {
        // failed to delete admin
        $_SESSION['delete'] = "<div class='danger'>Failed to deleted</div>";

        header('location:'.SITEURL.'admin/manage-admin.php');

    }

    // redirect to manage admin page with message (success/error)

?>