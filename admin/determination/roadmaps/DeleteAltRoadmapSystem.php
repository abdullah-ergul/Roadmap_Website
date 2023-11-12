<?php
include("../../../settings/connection.php");
$id = $_POST["id"];

mysqli_query($conn, "DELETE FROM `altroadmaps` WHERE `id`='$id'");
header("Location: ../../");


?>