<?php include(dirname(__FILE__) . '/common/header.php'); ?>
<?php include(dirname(__FILE__) . '/../db/connection.php'); ?>


<body>
    <div class="container-scroller">
        <!-- pages/common/_navbar.php -->
        <?php
        include(dirname(__FILE__) . '/common/navbar.php');

        if ($_SESSION['role'] == 'admin') {
        ?>

            <?php
            // Cards
            $sql = "Select * from `card2_data`";
            $result = mysqli_query($conn, $sql);
            $cards = mysqli_num_rows($result);
            $row = mysqli_fetch_assoc($result);
            if ($cards > 0){
            $rand = $row['rand_str'];
            $_SESSION['rand'] = $rand;
            }
            ?>
        <?php
            // Users
            $sql2 = "Select * from `card2_user`";
            $result2 = mysqli_query($conn, $sql2);
            $users = mysqli_num_rows($result2);
        } else {
        ?>

        <?php
            $id = $_SESSION['userID'];
            $sql = "SELECT * FROM `card2_user` WHERE `id`=$id";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $email = $row['email'];
            $_SESSION['email'] = $email;


            $sql2 = "SELECT * FROM `card2_data` WHERE `user_email` = '$email'";
            $result2 = mysqli_query($conn, $sql2);
            $cards = mysqli_num_rows($result2);
            $row2 = mysqli_fetch_assoc($result2);

            if ($cards > 0){
            $rand = $row2['rand_str'];
            $_SESSION['rand'] = $rand;
            }
        }
        ?>

        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- pages/common/_sidebar.php -->
            <?php include('common/sidebar.php'); ?>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="d-xl-flex justify-content-between align-items-start">
                        <h2 class="text-dark font-weight-bold mb-2"> Cards dashboard </h2>
                        <div class="d-sm-flex justify-content-xl-between align-items-center mb-2">

                            <div class="dropdown ms-0 ml-md-4 mt-2 mt-lg-0">
                                <button class="btn bg-white p-3 d-flex align-items-center" type="button"> <i class="mdi mdi-calendar me-1"></i>
                                    <span id="fullDate"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-sm-flex justify-content-between align-items-center transaparent-tab-border ">

                            </div>
                            <div class="tab-content tab-transparent-content">
                                <div class="tab-pane fade show active" id="business-1" role="tabpanel" aria-labelledby="business-tab">
                                    <div class="row">
                                        <div class="col-xl-3 col-lg-6 col-sm-6 grid-margin stretch-card" style="height: 17em">
                                            <div class="card">
                                                <div class="card-body text-center">
                                                    <h5 class="mb-2 text-dark font-weight-normal">Cards</h5>
                                                    <h2 class="mb-4 text-dark font-weight-bold"><?php echo $cards ?></h2>
                                                    <div class="dashboard-progress dashboard-progress-1 d-flex align-items-center justify-content-center item-parent">
                                                        <i style="top: 68%;" class="mdi mdi-lightbulb icon-md absolute-center text-dark"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-sm-6 grid-margin stretch-card" style="height: 17em">
                                            <?php
                                            if ($_SESSION['role'] == 'admin') {
                                            ?>
                                                <div class="card">
                                                    <div class="card-body text-center">
                                                        <h5 class="mb-2 text-dark font-weight-normal">Users</h5>
                                                        <h2 class="mb-4 text-dark font-weight-bold"><?php echo $users ?></h2>
                                                        <div class="dashboard-progress dashboard-progress-2 d-flex align-items-center justify-content-center item-parent">
                                                            <i style="top: 68%;" class="mdi mdi-account-circle icon-md absolute-center text-dark"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <footer class="footer">
                    <div class="footer-inner-wraper">
                        <div class="d-sm-flex justify-content-center justify-content-sm-between py-2">
                            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block"></span>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </div>


    <!--pages/common/_footer.php -->
    <?php include('common/footer.php'); ?>

    <!-- Dashboard -->
    <script src="<?php echo INV_ASSETS; ?>/js/dashboard.js"></script>
    <script src="<?php echo INV_ASSETS; ?>/vendors/jquery-circle-progress/js/circle-progress.min.js"></script>
    <!-- hamburger -->
    <script src="<?php echo INV_ASSETS; ?>/js/jquery.cookie.js" type="text/javascript"></script>
    <script src="<?php echo INV_ASSETS; ?>/js/off-canvas.js"></script>
    <script src="<?php echo INV_ASSETS; ?>/js/misc.js"></script>

    <script>
        // Date
        var d = new Date();

        var month = d.getMonth() + 1;
        var day = d.getDate();

        var fullDate =
            (day < 10 ? '0' : '') + day + ' ' +
            (month < 10 ? '0' : '') + month + ' ' +
            d.getFullYear();

        // let element = ;

        // console.log(element);

        jQuery('#fullDate').html(fullDate);
    </script>
</body>

</html>