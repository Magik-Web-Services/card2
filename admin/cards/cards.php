<?php include(dirname(__FILE__) . '/../common/header.php'); ?>
<?php include(dirname(__FILE__) . '/../../db/connection.php'); ?>

<style>
    #myTable tbody td {
        max-width: 100px !important;
        overflow: hidden;
    }
</style>

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
                <div class="content-wrapper">
                    <div class="CardLayout_tabs-container__bK_Ug">
                        <div>
                            <ul style="display: flex; list-style: none; border-bottom: 1px solid #d5dadd;">
                                <li><button class="step1 btn" data-step="1" style="border: none; font-weight: bolder;">Card View</button>
                                </li>
                                <li><button class="step2 btn" data-step="2" style="border: none;">QR Code</button></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">
                        <h3 class="page-title"> All Cards </h3>
                    </div>
                    <form action="delCard.php" method="POST">
                        <button type="submit" name="mDeletecard[]" class="btn btn-danger cardDelete">Delete</button>
                        <table border="1" class="mt-5 table" id="myTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>companyImg</th>
                                    <th>profileImg</th>
                                    <th>coverImg</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // include('allcards.php');
                                ?>
                            </tbody>
                        </table>
                    </form>
                </div>
                <footer class="footer">
                    <div class="footer-inner-wraper">
                        <div class="d-sm-flex justify-content-center justify-content-sm-between py-2">
                            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block"></span>

                        </div>
                    </div>
                </footer> -->
        </div>
    </div>
    </div>
    <?php include('../common/footer.php'); ?>
    <script src="<?php echo INV_ASSETS; ?>/js/misc.js"></script>
</body>

</html>