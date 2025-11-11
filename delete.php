<?php
require "db.php";
if (isset($_GET["id"])) {
    $id = $_GET["id"] ?? "";
    if ($id != "") {
        $sql = "DELETE FROM kariawan WHERE id='$id'";
        if (mysqli_query($conn, $sql)) {
            header('Location: index.php');
        } else {
            echo 'Error: ' . mysqli_error($conn);
        }
    }
}
