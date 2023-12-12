<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>

        <br />
        <?php
            if(isset($_SESSION['add'])) // check whether the session is set or not
            {
                echo $_SESSION['add']; 
                unset($_SESSION['add']);
            }
        ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name</td>
                    <td>
                        <input type="text" name="full_name" placeholder="Enter Your Name">
                    </td>
                </tr>

                <tr>
                    <td>Username</td>
                    <td>
                        <input type="text" name="username" placeholder="Enter Your Username">
                    </td>
                </tr>

                <tr>
                    <td>Password</td>
                    <td>
                        <input type="password" name="password" placeholder="Enter Your Password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn btn-secondary">
                    </td>
                </tr>
            </table>

        </form>
    </div>
</div>

<?php include('partials/footer.php') ?>

<?php
// process the value from form and save it into database

// check whether the submit button is clicked or not

if (isset($_POST['submit'])) {
    // get data frm form
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); // password encryption with MD5

    // SQL query to save data into database
    $sql = "INSERT INTO tbl_admin SET
            full_name = '$full_name',
            username = '$username',
            password = '$password'
        ";

    // execute query and save data in database
    $data = mysqli_query($conn, $sql) or die(mysqli_error());

    // check whether the (query is executed) data is inserted or not 
    if($data == TRUE)
    {
        // create a session variable to display message
        $_SESSION['add'] = "<div class='success'>Admin added successfully</div>";
        // redirect page to admin
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else {
        // failed to insert data
        $_SESSION['add'] = "<div class='danger'>Failed to add admin</div>";
        // redirect page to add admin
        header('location:'.SITEURL.'admin/add-admin.php');
    }
}


?>