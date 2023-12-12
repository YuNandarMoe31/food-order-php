<?php include('partials/menu.php'); ?>


<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>

        <br />

        <?php
            // get id of selected admin
            $id = $_GET['id'];

            // create sql query to get details
            $sql = "SELECT * FROM tbl_admin WHERE id=$id";

            // execute query
            $data = mysqli_query($conn, $sql);

            // check whether the query is executed or not
            if($data == TRUE)
            {
                $count = mysqli_num_rows($data);

                if($count == 1) {
                    $row = mysqli_fetch_assoc($data);
                    $full_name = $row['full_name'];
                    $username = $row['username'];
                } else {
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name</td>
                    <th>
                        <input type="text" name="full_name" value="<?php echo $full_name ?>">
                    </th>
                </tr>
                <tr>
                    <td>Username</td>
                    <th>
                        <input type="text" name="username" value="<?php echo $username ?>">
                    </th>
                </tr>
                <!-- <tr>
                    <td>Password</td>
                    <th>
                        <input type="password" name="password" value="">
                    </th>
                </tr> -->
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php
    // check whether the submit button is clicked or not
    if(isset($_POST['submit'])) {
        $id = $_POST['id'];
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];


        $sql = "UPDATE tbl_admin SET
            full_name= '$full_name',
            username='$username'
        WHERE id=$id
        ";

        $data = mysqli_query($conn, $sql);

        if($data == TRUE) {
            $_SESSION['update'] = "<div class='success'>Admin Updated Successfully</div>";
            header('location:'.SITEURL.'admin/manage-admin.php');
        } else {
            $_SESSION['update'] = "<div class='success'>Failed to update admin</div>";
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
    }
?>

<?php include('partials/footer.php'); ?>