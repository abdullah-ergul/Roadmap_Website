<?php
include("../../../settings/connection.php");
$id = $_GET["id"];
$username = $_POST["username"];
$email = $_POST["email"];
$permission = $_POST["permission"];
$updateuser = mysqli_query($conn, "UPDATE `users` SET `email`='$email',`username`='$username',`permission`='$permission' WHERE `id`='$id'");
header("Location: ../../");
?>