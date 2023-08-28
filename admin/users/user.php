<?php include(dirname(__FILE__) . '/../common/header.php'); ?>
<?php include(dirname(__FILE__) . '/../../db/connection.php'); ?>


<?php
if (isset($_POST['adduser'])) {
    $user_name = $_POST['user-name'];
    $user_email = $_POST['user-email'];
    $user_country = $_POST['user-country'];
    $user_password = $_POST['user-password'];
    $user_role = $_POST['user-role'];

    $hash = password_hash($user_password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO `card2_user` (`userName`, `email`, `country`, `password`, `role`) VALUES ('$user_name', '$user_email', '$user_country', '$hash', '$user_role');";
    $form = mysqli_query($conn, $sql);
}
// $2y$10$SCbtr9lHv5exaJeanjgu1.divMu0iUe8C5u/8bEHEidwwONy0pYG6
?>
<?php
if (isset($_POST['edituser'])) {
    $user_id = $_POST['user_id'];
    $user_name = $_POST['user-name'];
    $user_email = $_POST['user-email'];
    $user_country = $_POST['user-country'];
    $user_password = $_POST['user-password'];
    $user_role = $_POST['user-role'];

    $hash = password_hash($user_password, PASSWORD_DEFAULT);

    $sql = "UPDATE `card2_user` SET `userName`='$user_name',`email`='$user_email',`country`='$user_country',`password`='$hash',`role`='$user_role', `modified_user`=CURRENT_TIMESTAMP() WHERE `id`='$user_id';";
    $form = mysqli_query($conn, $sql);
}
?>


<body>
    <div class="container-scroller">
        <!-- common:../../common/_navbar.html -->

        <?php include('../common/navbar.php'); ?>
        <!-- common -->
        <div class="container-fluid page-body-wrapper">
            <!-- common:../../commons/_sidebar.html -->
            <?php include('../common/sidebar.php'); ?>
            <!-- common -->
            <div class="main-panel">
                <div class="row p-2">
                    <div class="col-12 p-0">
                        <div class="d-flex flex-row pb-4">
                            <h3>New User</h3>
                        </div>
                        <div class="p-4 mb-3 border rounded">
                            <form method="post">
                                <div class="row mb-0 align-items-center">
                                    <!-- Id -->
                                    <input type="hidden" class="form-control" id="user_id" name="user_id">
                                    <!--  -->
                                    <div class="col-2">
                                        <label for="user-name" class="col-form-label">User Name:</label>
                                        <input type="text" class="form-control" id="user-name" name="user-name" required>
                                    </div>
                                    <div class="col-2">
                                        <label for="user-email" class="col-form-label">User Email:</label>
                                        <input type="email" class="form-control" id="user-email" name="user-email" required>
                                    </div>
                                    <div class="col-2">
                                        <label for="user-country" class="col-form-label">User Country:</label>
                                        <!-- <input type="text" class="form-control" id="user-country" name="user-country" required> -->
                                        <select class="form-control" id="user-country" name="user-country">
                                            <option value="Country">Country</option>
                                            <option value="United States of America">United States of America</option>
                                            <option value="United Kingdom">United Kingdom</option>
                                            <option value="India">India</option>
                                            <option value="Germany">Germany</option>
                                            <option value="Argentina">Argentina</option>
                                        </select>
                                    </div>
                                    <div class="col-2">
                                        <label for="user-password" class="col-form-label">User Password:</label>
                                        <input type="text" class="form-control" id="user-password" name="user-password" required>
                                    </div>
                                    <div class="col-2">
                                        <label for="user-role" class="col-form-label">User Role:</label>
                                        <select class="form-control" id="user-role" name="user-role">
                                            <option value="admin">admin</option>
                                            <option value="user">user</option>
                                        </select>
                                    </div>
                                    <div class="col-2 text-center">
                                        <!-- <button id="edit_btn" type="submit" name="edit" class="btn btn-primary">Save changes</button> -->
                                        <input id="save_btn" type="submit" value="Add" class="btn btn-primary" name="adduser">
                                        <input id="edit_btn" type="submit" class="btn btn-primary d-none" value="Update" name="edituser">
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
                <div class="row border p-3 rounded">
                    <div class="col-12">
                        <table id="example" class="table table-hover my-0 dt-responsive nowrap" style="width:100% !important;margin-top: 15px !important;margin-bottom: 15px !important;">
                            <thead>
                                <tr>
                                    <th>UserName</th>
                                    <th>Email</th>
                                    <th>Country</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include('allUser.php')
                                ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- common:../../commons/_footer.html -->
    <?php include('../common/footer.php'); ?>
    <script src="<?php echo INV_ASSETS; ?>/js/misc.js"></script>
</body>

</html>