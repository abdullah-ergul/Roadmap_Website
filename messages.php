<?php
    include("./settings/connection.php");
    session_start();
    if(!isset($_SESSION["id"])) {
        header("Location:./");
    }
    $sessionid = $_SESSION["id"];

    $firstlove = mysqli_query($conn,"SELECT * FROM `messages` WHERE `from`='$sessionid' OR `whom`='$sessionid'");
    $firstlovenumber = mysqli_num_rows($firstlove);
    if($firstlovenumber == 0) {
        header("Location: adminemesajgonder.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<?php
    
    if(!isset($_GET["messagerid"])) {
    $chooseid = mysqli_query($conn,"SELECT * FROM `messages` WHERE NOT `from`='$sessionid' LIMIT 1");
    $chooseidrow = mysqli_fetch_array($chooseid);
    $messagerid = $chooseidrow["from"];
    }
    else {
        $messagerid = $_GET["messagerid"];
    }
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            background-color: #f4f7f6;
            margin-top: 20px;
        }

        .card {
            background: #fff;
            transition: .5s;
            border: 0;
            margin-bottom: 30px;
            border-radius: .55rem;
            position: relative;
            width: 100%;
            box-shadow: 0 1px 2px 0 rgb(0 0 0 / 10%);
        }

        .chat-app .people-list {
            width: 280px;
            position: absolute;
            left: 0;
            top: 0;
            padding: 20px;
            z-index: 7
        }

        .chat-app .chat {
            margin-left: 280px;
            border-left: 1px solid #eaeaea
        }

        .people-list {
            -moz-transition: .5s;
            -o-transition: .5s;
            -webkit-transition: .5s;
            transition: .5s
        }

        .people-list .chat-list li {
            padding: 10px 15px;
            list-style: none;
            border-radius: 3px
        }

        .people-list .chat-list li:hover {
            background: #efefef;
            cursor: pointer
        }

        .people-list .chat-list li.active {
            background: #efefef
        }

        .people-list .chat-list li .name {
            font-size: 15px
        }

        .people-list .chat-list img {
            width: 45px;
            border-radius: 50%
        }

        .people-list img {
            float: left;
            border-radius: 50%
        }

        .people-list .about {
            float: left;
            padding-left: 8px
        }

        .people-list .status {
            color: #999;
            font-size: 13px
        }

        .chat .chat-header {
            padding: 15px 20px;
            border-bottom: 2px solid #f4f7f6
        }

        .chat .chat-header img {
            float: left;
            border-radius: 40px;
            width: 40px
        }

        .chat .chat-header .chat-about {
            float: left;
            padding-left: 10px
        }

        .chat .chat-history {
            padding: 20px;
            border-bottom: 2px solid #fff
        }

        .chat .chat-history ul {
            padding: 0
        }

        .chat .chat-history ul li {
            list-style: none;
            margin-bottom: 30px
        }

        .chat .chat-history ul li:last-child {
            margin-bottom: 0px
        }

        .chat .chat-history .message-data {
            margin-bottom: 15px
        }

        .chat .chat-history .message-data img {
            border-radius: 40px;
            width: 40px
        }

        .chat .chat-history .message-data-time {
            color: #434651;
            padding-left: 6px
        }

        .chat .chat-history .message {
            color: #444;
            padding: 18px 20px;
            line-height: 26px;
            font-size: 16px;
            border-radius: 7px;
            display: inline-block;
            position: relative
        }

        .chat .chat-history .message:after {
            bottom: 100%;
            left: 7%;
            border: solid transparent;
            content: " ";
            height: 0;
            width: 0;
            position: absolute;
            pointer-events: none;
            border-bottom-color: #fff;
            border-width: 10px;
            margin-left: -10px
        }

        .chat .chat-history .my-message {
            background: #efefef
        }

        .chat .chat-history .my-message:after {
            bottom: 100%;
            left: 30px;
            border: solid transparent;
            content: " ";
            height: 0;
            width: 0;
            position: absolute;
            pointer-events: none;
            border-bottom-color: #efefef;
            border-width: 10px;
            margin-left: -10px
        }

        .chat .chat-history .other-message {
            background: #e8f1f3;
            text-align: right
        }

        .chat .chat-history .other-message:after {
            border-bottom-color: #e8f1f3;
            left: 93%
        }

        .chat .chat-message {
            padding: 20px
        }

        .online,
        .offline,
        .me {
            margin-right: 2px;
            font-size: 8px;
            vertical-align: middle
        }

        .online {
            color: #86c541
        }

        .offline {
            color: #e47297
        }

        .me {
            color: #1d8ecd
        }

        .float-right {
            float: right
        }

        .clearfix:after {
            visibility: hidden;
            display: block;
            font-size: 0;
            content: " ";
            clear: both;
            height: 0
        }

        @media only screen and (max-width: 767px) {
            .chat-app .people-list {
                height: 465px;
                width: 100%;
                overflow-x: auto;
                background: #fff;
                left: -400px;
                display: none
            }

            .chat-app .people-list.open {
                left: 0
            }

            .chat-app .chat {
                margin: 0
            }

            .chat-app .chat .chat-header {
                border-radius: 0.55rem 0.55rem 0 0
            }

            .chat-app .chat-history {
                height: 300px;
                overflow-x: auto
            }
        }

        @media only screen and (min-width: 768px) and (max-width: 992px) {
            .chat-app .chat-list {
                height: 650px;
                overflow-x: auto
            }

            .chat-app .chat-history {
                height: 600px;
                overflow-x: auto
            }
        }

        @media only screen and (min-device-width: 768px) and (max-device-width: 1024px) and (orientation: landscape) and (-webkit-min-device-pixel-ratio: 1) {
            .chat-app .chat-list {
                height: 480px;
                overflow-x: auto
            }

            .chat-app .chat-history {
                height: calc(100vh - 350px);
                overflow-x: auto
            }
        }
        a {
            text-decoration: none;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card chat-app">
                    <div id="plist" class="people-list">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <a href="./index.php">
                                    <span class="input-group-text" >
                                        <i class="fas fa-undo-alt"></i>
                                    </span>
                                </a>
                            </div>
                            <!-- <input type="text" class="form-control" placeholder="Search..."> -->
                        </div>
                        <ul class="list-unstyled chat-list mt-2 mb-0">
                            <?php
                            $sidemessage = mysqli_query($conn,"SELECT DISTINCT `from` FROM `messages` WHERE `whom`='$sessionid' ORDER BY `date` DESC");
                            $number = mysqli_num_rows($sidemessage);
                            if($number==0) {
                                $status = "online";
                                $username = "Admin";
                                echo '
                                <li class="clearfix">
                                <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="avatar">
                                <div class="about">
                                <div class="name"><a href="messages.php?messagerid=1">'. $username .'</a><i class="fa fa-circle '. $status .'"></i></div>
                                
                                </div>
                                </li>
                                ';
                            } else {

                                while($siderow = mysqli_fetch_array($sidemessage)) {
                                    $userid = $siderow["from"];
                                $bunununutma = mysqli_query($conn,"SELECT * FROM `messages` WHERE `from`='$userid' AND `whom`='$sessionid' ORDER BY `date` DESC LIMIT 1");
                                $bunununutmarow = mysqli_fetch_array($bunununutma);

                                $findusername = mysqli_query($conn, "SELECT * FROM `users` WHERE `id`='$userid'");
                                $findname = mysqli_fetch_array($findusername);
                                $username = $findname["username"];
                                
                                if($bunununutmarow["seen"] == 0) {
                                    $status = "offline";
                                } else {
                                    $status = "online";
                                }
                                echo '
                                <li class="clearfix">
                                <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="avatar">
                                <div class="about">
                                <div class="name"><a href="messages.php?messagerid='. $siderow["from"] .'">'. $username .'</a><i class="fa fa-circle '. $status .'"></i></div>
                                
                                </div>
                                </li>
                                ';
                                }
                            }
                            ?>
                        </ul>
                    </div>
                    <div class="chat">
                        <div class="chat-header clearfix">
                            <div class="row">
                                <div class="col-lg-6">
                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#view_info">
                                        <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="avatar">
                                    </a>
                                    <div class="chat-about">
                                        <h6 class="m-b-0"><?php


                                        $everything = mysqli_query($conn,"SELECT * FROM `messages` WHERE `from`='$messagerid' AND `whom`='$sessionid'");
                                        $fromusername = mysqli_query($conn, "SELECT * FROM `users` WHERE `id`='$messagerid'");
                                        $fromusers = mysqli_fetch_array($fromusername);
                                        echo $fromusers["username"];
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="chat-history">
                            <ul class="m-b-0">
                                <?php
                                    $messagehistory = mysqli_query($conn,"SELECT * FROM `messages`");
                                    while($messagerow = mysqli_fetch_array($messagehistory)) {
                                        if($messagerow["from"]==$messagerid && $messagerow["whom"]==$sessionid) {
                                            echo '
                                            <li class="clearfix">
                                                <div class="message-data">
                                                <span class="message-data-time">'. $messagerow["date"] .'</span>
                                                </div>
                                                <div class="message my-message">'. $messagerow["content"] .'</div>
                                            </li>
                                            ';
                                        
                                        }
                                        else if($messagerow["whom"]==$messagerid && $messagerow["from"]==$sessionid) {
                                        echo '
                                            <li class="clearfix">
                                            <div class="message-data text-right">
                                                <span class="message-data-time float-right">'. $messagerow["date"] .'</span>
                                            </div>
                                            <div class="message other-message float-right">'.$messagerow["content"].'</div>
                                        </li>
                                        ';
                                    
                                        }
                                    }
                                ?>
                                <!-- <li class="clearfix">
                                    <div class="message-data text-right">
                                    </div>
                                    <div class="message other-message float-right"> Hi Aiden, how are you? How is the
                                        project coming along? </div>
                                </li> -->
                                <!-- <li class="clearfix">
                                    <div class="message-data">
                                        <span class="message-data-time">10:12 AM, Today</span>
                                    </div>
                                    <div class="message my-message">Are we meeting today?</div>
                                </li> -->
                            </ul>
                        </div>
                        <form action="./determination/messagesystem/insertSystem.php?messagesender=<?php echo $messagerid;?>" method="post" style="width:65vw">
                        <div class="chat-message clearfix">
                            <div class="input-group mb-0">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><button type="submit" style="border:none;"><i class="fa fas fa-paper-plane fa-1.5x"></i></button></span>
                                </div>
                                    <input type="text" name="message" class="form-control" placeholder="Enter text here...">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    if($status=="offline") {
        mysqli_query($conn, "UPDATE `messages` SET `seen`=1 WHERE `from`='$messagerid' AND `whom`='$sessionid' ORDER BY `date` DESC LIMIT 1");
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
</body>

</html>