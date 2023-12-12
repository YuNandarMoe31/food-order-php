<?php include('partials/menu.php') ?>

<!-- Main Content Section Starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Admin</h1>
        <br /><br />
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add']; // displaying session message
            unset($_SESSION['add']); // removing session message
        }
        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete']; // displaying session message
            unset($_SESSION['delete']); // removing session message
        }
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update']; // displaying session message
            unset($_SESSION['update']); // removing session message
        }
        if (isset($_SESSION['user-not-found'])) {
            echo $_SESSION['user-not-found']; // displaying session message
            unset($_SESSION['user-not-found']); // removing session message
        }
        if (isset($_SESSION['pwd-not-much'])) {
            echo $_SESSION['pwd-not-much']; // displaying session message
            unset($_SESSION['pwd-not-much']); // removing session message
        }
        if (isset($_SESSION['change-pwd'])) {
            echo $_SESSION['change-pwd']; // displaying session message
            unset($_SESSION['change-pwd']); // removing session message
        }
        ?>
        <br /><br />
        <a href="add-admin.php" class="btn btn-primary">Add Admin</a>
        <table class="tbl-full">
            <thead>
                <tr>
                    <th>S.N.</th>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Action</th>
                </tr>
            </thead>

            <?php
            // query to get all admin
            $sql = "SELECT * FROM tbl_admin";

            // execute the query
            $data = mysqli_query($conn, $sql);

            // check whether the query is executed or not
            if ($data == TRUE) {
                // count rows to check whether we have data in database or not
                $count = mysqli_num_rows($data); // function to get all rows in database
                $sn = 1;

                if ($count > 0) {
                    while ($rows = mysqli_fetch_assoc($data)) {
                        // using while loop to get all data from database
                        // get individual data
                        $id = $rows['id'];
                        $full_name = $rows['full_name'];
                        $username = $rows['username'];

                        // display the values in our table
            ?>
                        <tbody>
                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $full_name; ?></td>
                                <td><?php echo $username; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn btn-primary">Change Password</a>
                                    <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn btn-secondary">Update</a>
                                    <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        </tbody>

            <?php
                    }
                } else {
                    // we do not have data in database
                }
            }
            ?>
        </table>
    </div>
</div>
<!-- Main Content Section Ends -->

<?php include('partials/footer.php') ?>