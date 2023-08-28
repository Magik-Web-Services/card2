<?php
include(dirname(__FILE__)."/../../db/connection.php");


if ($_SESSION['role'] == 'admin') {
    $sql2 = "select * from card2_data";
}else{
    $email = $_SESSION['email'];
    $sql2 = "SELECT * FROM `card2_data` WHERE `user_email` = '$email'";
}

$result = mysqli_query($conn,$sql2);

while ($row = $result->fetch_assoc()) {
    $profile = $row['profile'];
    $obj =  json_decode($profile);
    $ar = get_object_vars($obj);

    $ar2 = $ar['Name'];
    $ar3 = get_object_vars($ar2);

    $name = $ar3['firstname'] ? $ar3['firstname'] : "";
    $cover =$row['profileImg'] != "-" ? $row['firstname'] : "../../images/cover.svg";
    $profileImg = $row['profileImg'] != "-" ? $row['profileImg'] : "../../images/profile.svg";
    $company = $row['companyImg'] != "-" ? $row['companyImg'] : "../../images/logo.png";

    echo "
            <tr>
            <td><input type='checkbox' name='mdeleteIdCards[]' value='" .  $row["id"] . "'></td>
                <td>" . $row["id"] . "</td>
                <td> " . $name . " </td>
                <td> <img src=" . $company . "></td>
                <td> <img src=" . $profileImg  . "> </td>
                <td> <img src=" . $cover . "> </td>
                <td>
                <a>
                    <i id='".$row["rand_str"]."' class='fa-solid fa-pen-to-square editcard' data-bs-toggle='modal' data-bs-target='#cardModal' style='color: #0fff4b; cursor: pointer;'></i>
                </a>
                <a>
                <i id='".$row["id"]."'class='fa-solid fa-trash delCard' style='color: #ff0000; cursor: pointer;'></i>
                </a>
                </td>
            </tr>
                ";
}