<?php

    // authorization
    if(!isset($_SESSION['user'])) {
        $_SESSION['no-login-message'] = "<div class='danger'>Please login to access admin panel</div>";

        header('location:'.SITEURL.'admin/login.php');
    }

?>