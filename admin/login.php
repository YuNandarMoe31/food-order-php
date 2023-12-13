<?php include('../config/constants.php') ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <div class="login">
        <h1>Login</h1>

        <?php
            if(isset($_SESSION['login'])) {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }
            if(isset($_SESSION['no-login-message'])) {
                echo $_SESSION['no-login-message'];
                unset($_SESSION['no-login-message']);
            }
        ?>
        <!-- Login Form Starts -->
        <form action="" method="POST">
            <div><br>
                Username:
                <input type="text" name="username" placeholder="Enter Username">
            </div><br>
            <div>
                Password:
                <input type="password" name="password" placeholder="Enter Password">
            </div><br>

            <input type="submit" value="Submit" name="submit">
        </form>
        <!-- Login Form Ends -->
    </div>
</body>

</html>

<?php 
    if(isset($_POST['submit'])) {
        // get data from login form
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        // SQL to check whether the user with username and password exists or not
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

        // execute query
        $data = mysqli_query($conn, $sql);

        $count = mysqli_num_rows($data);

        if($count == 1) {
            $_SESSION['login'] = "<div class='success'>Login successfully</div>";
            $_SESSION['user'] = $username;

            header('location:'.SITEURL.'admin/');
        } else {
            $_SESSION['login'] = "<div class='danger'>Username or password did not match</div>";
            header('location:'.SITEURL.'admin/login.php');
        }
    }

?>