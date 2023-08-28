<?php
include(dirname(__FILE__)."/../../db/connection.php");
$sql2 = "select * from card2_user";
$result = mysqli_query($conn,$sql2);

while ($row = $result->fetch_assoc()) {
    echo "<tr>
                <td>" . $row["userName"] . "</td>
                <td>" . $row["email"] . "</td>
                <td>" . $row["country"] . "</td>
                <td>" . $row["role"] . "</td>
                <td>
                <a>
                    <i id='".$row["id"]."' class='fa-solid curso fa-pen-to-square edituser' style='color: #0fff4b; cursor: pointer;'></i>
                </a>
                <a>
                <i id='".$row["id"]."'class='fa-solid fa-trash deleteUser' style='color: #ff0000; cursor: pointer;'></i>
                </a>
                </td>
            </tr>";
}