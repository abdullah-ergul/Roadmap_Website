<?php
session_start();

if(isset($_GET["page"])) {

    if($_GET["page"] == "register" && !isset($_SESSION["id"])) {
        include("./pages/register.php");
    }
    else if(!isset($_SESSION["id"]) || empty($_GET["page"])) {
        include("./pages/login.php");
    }
    else if(isset($_SESSION["id"]) && $_GET["page"]=="roadmap") {
        include("./pages/roadmap.php");
    }
    else if($_GET["page"]=="announcements") {
        include("./pages/announcements.php");
    }

}
else if(isset($_SESSION["id"])) {
    include("./pages/announcements.php");
}
else {
    include("./pages/login.php");
}

?>
