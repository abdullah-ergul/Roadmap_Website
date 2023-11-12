<?php
include("../../../settings/connection.php");
$roadmapname = $_POST["roadmapname"];
$sql = mysqli_query($conn,"INSERT INTO `roadmaps` (`name`) VALUES ('$roadmapname')");
header("Location: ../../");
?>