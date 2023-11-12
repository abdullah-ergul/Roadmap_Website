<?php
session_start();
include("../../settings/connection.php");
$message = $_POST["message"];
$id = $_SESSION["id"];
$messagerid = $_GET["messagesender"];

mysqli_query($conn,"INSERT INTO `messages` (`from`,`whom`,`content`) VALUES('$id','$messagerid','$message')");
header("Location: ../../messages.php?messagerid=".$messagerid);
?>