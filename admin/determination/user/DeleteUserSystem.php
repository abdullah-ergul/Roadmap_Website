<?php
include("../../../settings/connection.php");
$id = $_POST["id"];

mysqli_query($conn, "DELETE FROM `users` WHERE `id`='$id'");
header("Location: ../../");

?>