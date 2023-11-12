<?php
include("../../../settings/connection.php");
$id = $_POST["id"];

mysqli_query($conn, "DELETE FROM `roadmaps` WHERE `id`='$id'");
mysqli_query($conn, "DELETE FROM `altroadmaps` WHERE `roadmap_id`='$id'");
header("Location: ../../");


?>