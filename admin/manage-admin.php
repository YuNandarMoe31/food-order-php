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
                                    <a href="#" class="btn btn-secondary">Update</a>
                                    <a href="#" class="btn btn-danger">Delete</a>
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