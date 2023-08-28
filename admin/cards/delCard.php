<?php
include_once("../../db/connection.php");
// Customerdeletes
if (isset($_GET['cardDelete'])) {

    $sno = $_GET['cardDelete'];
    $deleteSql = "DELETE FROM `card2_data` WHERE `id` = $sno";
    $deleteServer = mysqli_query($conn, $deleteSql);
    header("Location: cards.php");
}

if (isset($_POST['mDeletecard'])) {
    foreach ($_POST['mdeleteIdCards'] as $key) {
        echo $key;
        $MdeleteSql = "DELETE FROM `card2_data` WHERE `id` = $key";
        $deleteServer = mysqli_query($conn, $MdeleteSql);
    }
    header("Location: cards.php");
}
