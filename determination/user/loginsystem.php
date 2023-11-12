<?php
session_start();
include("../../settings/connection.php");
$username = $_POST["username"];
$password = $_POST["password"];

echo "Username:" . ($username==="") . "<br>" . "Password:" . ($password==="");

if( empty($username) || !isset($username) || empty($password) || !isset($password)) {
    header("Location: ../../index.php?errorcode=2");
} 
else{
    $passwordhashed = hash('sha256', $password);
    
    if(stripos($username, "@")) {
        $check = mysqli_query($conn, "SELECT * FROM `USERS` WHERE `email`='$username' AND `password`='$passwordhashed'");
    }
    else {
        $check = mysqli_query($conn, "SELECT * FROM `USERS` WHERE `username`='$username' AND `password`='$passwordhashed'");
    }

    $checknumber = mysqli_num_rows($check);
    if($checknumber == 0) {
        header("Location: ../../index.php?errorcode=1");
    } else if ($checknumber >= 1) {
        $row = mysqli_fetch_array($check);
        $_SESSION["id"] = $row["id"];
        $_SESSION["username"] = $row["username"];
        $_SESSION["permission"] = $row["permission"];
        header("Location: ../../index.php");
    }
}
?>