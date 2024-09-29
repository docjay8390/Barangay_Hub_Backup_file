<?php
require("connect.php");

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $update_query = "UPDATE `bpermit` SET `Statuss` = 'Ready to Pickup' WHERE `id` = '$id'";

    if (mysqli_query($connection, $update_query)) {
        echo "success"; // Return "success" to indicate successful update
    } else {
        echo "error"; // Return "error" to indicate failure
    }
}
