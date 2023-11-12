<?php
include("../../../settings/connection.php");
$id = $_POST["id"];

$insertannouncementdata = mysqli_query($conn, "DELETE FROM `announcements` WHERE `id`='$id'");
header("Location:../../");
?>