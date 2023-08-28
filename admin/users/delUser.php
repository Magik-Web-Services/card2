<?php
include_once("../../db/connection.php");
// Customerdeletes
if (isset($_GET['userDelete'])) {
    $sno = $_GET['userDelete'];
    $deleteSql = "DELETE FROM `card2_user` WHERE `id` = $sno";
    $deleteServer = mysqli_query($conn, $deleteSql);
    // if ($deleteServer) {
    //     echo "Delete";
    // } else {
    //     echo "User Not Delete";
    // }
    header("Location: user.php");
}