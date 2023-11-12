<?php 
include("../../settings/connection.php");

$email = $_POST["email"];
$password = $_POST["password"];
$passwordconfirm = $_POST["passwordconfirm"];
$username = $_POST["username"];

if($password != $passwordconfirm) {
    header("Location: ../../index.php?page=register&errorcode=4");
}
else {
    $control = mysqli_query($conn, "SELECT * FROM `users` WHERE `email`='$email' OR `username`='$username'");
    $controlnumber = mysqli_num_rows($control);

    if($controlnumber > 0) {
        header("Location: ../../index.php?page=register&errorcode=3");
    }
    else if($controlnumber == 0) {
        $passwordhashed = hash('sha256', $password);
        $insertdata = mysqli_query($conn,"INSERT INTO `users` (`username`,`email`,`password`,`permission`) VALUES ('$username','$email','$passwordhashed','0')");
        header("Location: ./logoutsystem.php");
    }
    else {
        header("Location: ./logoutsystem.php");
    }
}

?>