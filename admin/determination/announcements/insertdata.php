<?php
include("../../../settings/connection.php");
$announcementcontent = $_POST["announcement"];
$insertannouncementdata = mysqli_query($conn, "INSERT INTO `announcements` (`content`) VALUES ('$announcementcontent')");
header("Location:../../");
?>