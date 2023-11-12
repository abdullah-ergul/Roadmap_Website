<?php
session_start();
if(!isset($_SESSION["id"])) {
    header("Location: ../../index.php");
}
else {
    $id = $_SESSION["id"];
    $oldpassword = $_POST["oldpassword"];
    $newpassword = $_POST["newpassword"];
    $newpasswordconfirm = $_POST["newpasswordconfirm"];

    if($newpassword != $newpasswordconfirm) {
        header("Location: ../../pages/changepassword.php?errorcode=5");
    }
    else {
        include("../../settings/connection.php");
        $username = $_SESSION["username"];
        $OldPasswordHashed = hash("sha256" , $oldpassword);
        $control = mysqli_query($conn, "SELECT * FROM `users` WHERE `username`='$username' AND `password`='$OldPasswordHashed'");
        $controlnumber = mysqli_num_rows($control);
        if($controlnumber == 1) {
            $newPasswordHashed = hash("sha256",$newpassword);
            $updateusersettings = mysqli_query($conn, "UPDATE `users` SET `password`='$newPasswordHashed' WHERE `username`='$username' AND `id`='$id'");
            header("Location: ./logoutsystem.php");
        }
        else {
            header("Location: ../../pages/changepassword.php?errorcode=6");
        }
    }
}



?>