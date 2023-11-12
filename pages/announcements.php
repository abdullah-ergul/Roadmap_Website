<?php
    include("./settings/connection.php");
    if(!isset($_SESSION["id"])) {
        header("Location:../");
    }
?>

<style>
  body {
    margin-left: 0;
    padding: 0;
    background: #121212;

    color: #AAAA;
    font-family: 'Open Sans', sans-serif;
    font-size: 112.5%;
    line-height: 1.6em;
  }

  a {
    text-decoration: none;
    color: white;
  }

  /* ================ The Timeline ================ */

  .timeline {
    position: relative;
    width: 660px;
    margin: 0 auto;
    margin-top: 20px;
    padding: 1em 0;
    list-style-type: none;
  }

  .timeline:before {
    position: absolute;
    left: 50%;
    top: 0;
    content: ' ';
    display: block;
    width: 6px;
    height: 100%;
    margin-left: -3px;
    background: rgb(80, 80, 80);
    background: -moz-linear-gradient(top, rgba(80, 80, 80, 0) 0%, rgb(80, 80, 80) 8%, rgb(80, 80, 80) 92%, rgba(80, 80, 80, 0) 100%);
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgba(30, 87, 153, 1)), color-stop(100%, rgba(125, 185, 232, 1)));
    background: -webkit-linear-gradient(top, rgba(80, 80, 80, 0) 0%, rgb(80, 80, 80) 8%, rgb(80, 80, 80) 92%, rgba(80, 80, 80, 0) 100%);
    background: -o-linear-gradient(top, rgba(80, 80, 80, 0) 0%, rgb(80, 80, 80) 8%, rgb(80, 80, 80) 92%, rgba(80, 80, 80, 0) 100%);
    background: -ms-linear-gradient(top, rgba(80, 80, 80, 0) 0%, rgb(80, 80, 80) 8%, rgb(80, 80, 80) 92%, rgba(80, 80, 80, 0) 100%);
    background: linear-gradient(to bottom, rgba(80, 80, 80, 0) 0%, rgb(80, 80, 80) 8%, rgb(80, 80, 80) 92%, rgba(80, 80, 80, 0) 100%);

    z-index: 5;
  }

  .timeline li {
    padding: 1em 0;
  }

  .timeline li:after {
    content: "";
    display: block;
    height: 0;
    clear: both;
    visibility: hidden;
  }

  .direction-l {
    position: relative;
    width: 300px;
    float: left;
    text-align: right;
  }

  .direction-r {
    position: relative;
    width: 300px;
    float: right;
  }

  .flag-wrapper {
    position: relative;
    display: inline-block;

    text-align: center;
  }

  .flag,
  .finished {
    position: relative;
    display: inline;
    background: black;
    padding: 6px 10px;
    border-radius: 5px;

    font-weight: 600;
    text-align: left;
  }

  .direction-l .flag,
  .direction-l .finished {
    -webkit-box-shadow: -1px 1px 1px rgba(0, 0, 0, 0.15), 0 0 1px rgba(0, 0, 0, 0.15);
    -moz-box-shadow: -1px 1px 1px rgba(0, 0, 0, 0.15), 0 0 1px rgba(0, 0, 0, 0.15);
    box-shadow: -1px 1px 1px rgba(0, 0, 0, 0.15), 0 0 1px rgba(0, 0, 0, 0.15);
  }

  .direction-r .flag,
  .direction-r .finished {
    -webkit-box-shadow: 1px 1px 1px rgba(0, 0, 0, 0.15), 0 0 1px rgba(0, 0, 0, 0.15);
    -moz-box-shadow: 1px 1px 1px rgba(0, 0, 0, 0.15), 0 0 1px rgba(0, 0, 0, 0.15);
    box-shadow: 1px 1px 1px rgba(0, 0, 0, 0.15), 0 0 1px rgba(0, 0, 0, 0.15);
  }

  .direction-l .flag:before,
  .direction-r .flag:before {
    position: absolute;
    top: 50%;
    right: -40px;
    content: ' ';
    display: block;
    width: 12px;
    height: 12px;
    margin-top: -10px;
    background: #fff;
    border-radius: 10px;
    border: 4px solid rgb(255, 80, 80);
    z-index: 10;
  }

  .direction-l .finished:before,
  .direction-r .finished:before {
    position: absolute;
    top: 50%;
    right: -40px;
    content: ' ';
    display: block;
    width: 12px;
    height: 12px;
    margin-top: -10px;
    background: #fff;
    border-radius: 10px;
    border: 4px solid rgb(255, 80, 80);
    background: rgb(255, 80, 80);
    z-index: 10;
  }

  .direction-r .flag:before {
    left: -40px;
  }

  .direction-l .flag:after {
    content: "";
    position: absolute;
    left: 100%;
    top: 50%;
    height: 0;
    width: 0;
    margin-top: -8px;
    border: solid transparent;
    border-left-color: black;
    border-width: 8px;
    pointer-events: none;
  }

  .direction-r .flag:after {
    content: "";
    position: absolute;
    right: 100%;
    top: 50%;
    height: 0;
    width: 0;
    margin-top: -8px;
    border: solid transparent;
    border-right-color: black;
    border-width: 8px;
    pointer-events: none;
  }

  .time-wrapper {
    display: inline;

    line-height: 1em;
    font-size: 0.66666em;
    color: #AAAA;
    vertical-align: middle;
  }

  .direction-l .time-wrapper {
    float: left;
  }

  .direction-r .time-wrapper {
    float: right;
  }

  .time {
    display: inline-block;
    padding: 4px 6px;
    background: black;
  }

  .desc {
    margin: 1em 0.75em 0 0;

    font-size: 0.77777em;
    font-style: italic;
    line-height: 1.5em;
  }

  .direction-r .desc {
    margin: 1em 0 0 0.75em;
  }

  /* ================ Timeline Media Queries ================ */

  @media screen and (max-width: 660px) {

    .timeline {
      width: 100%;
      padding: 4em 0 1em 0;
      margin-left: 4vh;
    }

    .timeline li {
      padding: 2em 0;
    }

    .direction-l,
    .direction-r {
      float: none;
      width: 100%;

      text-align: center;
    }

    .flag-wrapper {
      text-align: center;
    }

    .flag {
      background: black;
      z-index: 15;
    }

    .direction-l .flag:before,
    .direction-r .flag:before {
      position: absolute;
      top: -30px;
      left: 50%;
      content: ' ';
      display: block;
      width: 12px;
      height: 12px;
      margin-left: -9px;
      background: #fff;
      border-radius: 10px;
      border: 4px solid rgb(255, 80, 80);
      z-index: 10;
    }

    .direction-l .flag:after,
    .direction-r .flag:after {
      content: "";
      position: absolute;
      left: 50%;
      top: -8px;
      height: 0;
      width: 0;
      margin-left: -8px;
      border: solid transparent;
      border-bottom-color: black;
      border-width: 8px;
      pointer-events: none;
    }

    .time-wrapper {
      display: block;
      position: relative;
      margin: 4px 0 0 0;
      z-index: 14;
    }

    .direction-l .time-wrapper {
      float: none;
    }

    .direction-r .time-wrapper {
      float: none;
    }

    .desc {
      position: relative;
      margin: 1em 0 0 0;
      padding: 1em;
      background: rgb(245, 245, 245);
      -webkit-box-shadow: 0 0 1px rgba(0, 0, 0, 0.20);
      -moz-box-shadow: 0 0 1px rgba(0, 0, 0, 0.20);
      box-shadow: 0 0 1px rgba(0, 0, 0, 0.20);

      z-index: 15;
    }

    .direction-l .desc,
    .direction-r .desc {
      position: relative;
      margin: 1em 1em 0 1em;
      padding: 1em;

      z-index: 15;
    }

  }

  @media screen and (min-width: 400px ?? max-width: 660px) {

    .direction-l .desc,
    .direction-r .desc {
      margin: 1em 4em 0 4em;
    }

  }

  .center {
    display: flex;
    flex-direction: center;
    align-items: center;
    justify-content: center;
    width: 100vw;
  }

  /*
  https://developer.mozilla.org/en/docs/Web/CSS/box-shadow
  box-shadow: [inset?] [top] [left] [blur] [size] [color];

  Tips:
    - We're setting all the blurs to 0 since we want a solid fill.
    - Add the inset keyword so the box-shadow is on the inside of the element
    - Animating the inset shadow on hover looks like the element is filling in from whatever side you specify ([top] and [left] accept negative values to become [bottom] and [right])
    - Multiple shadows can be stacked
    - If you're animating multiple shadows, be sure to keep the same number of shadows on hover/focus as non-hover/focus (even if you have to create a transparent shadow) so the animation is smooth. Otherwise, you'll get something choppy.
  */
  .fill:hover,
  .fill:focus {
    box-shadow: inset 0 0 0 2em var(--hover);
  }

  .pulse:hover,
  .pulse:focus {
    -webkit-animation: pulse 1s;
    animation: pulse 1s;
    box-shadow: 0 0 0 2em transparent;
  }

  @-webkit-keyframes pulse {
    0% {
      box-shadow: 0 0 0 0 var(--hover);
    }
  }

  @keyframes pulse {
    0% {
      box-shadow: 0 0 0 0 var(--hover);
    }
  }

  .close:hover,
  .close:focus {
    box-shadow: inset -3.5em 0 0 0 var(--hover), inset 3.5em 0 0 0 var(--hover);
  }

  .raise:hover,
  .raise:focus {
    box-shadow: 0 0.5em 0.5em -0.4em var(--hover);
    transform: translateY(-0.25em);
  }

  .up:hover,
  .up:focus {
    box-shadow: inset 0 -3.25em 0 0 var(--hover);
  }

  .slide:hover,
  .slide:focus {
    box-shadow: inset 6.5em 0 0 0 var(--hover);
  }

  .offset {
    box-shadow: 0.3em 0.3em 0 0 var(--color), inset 0.3em 0.3em 0 0 var(--color);
  }

  .offset:hover,
  .offset:focus {
    box-shadow: 0 0 0 0 var(--hover), inset 6em 3.5em 0 0 var(--hover);
  }

  .fill {
    --color: #a972cb;
    --hover: #cb72aa;
  }

  .pulse {
    --color: #ef6eae;
    --hover: #ef8f6e;
  }

  .close {
    --color: #ff7f82;
    --hover: #ffdc7f;
  }

  .raise {
    --color: #ffa260;
    --hover: #e5ff60;
  }

  .up {
    --color: #e4cb58;
    --hover: #94e458;
  }

  .slide {
    --color: #8fc866;
    --hover: #66c887;
  }

  .offset {
    --color: #19bc8b;
    --hover: #1973bc;
  }

  button {
    color: var(--color);
    transition: 0.25s;
  }

  button:hover,
  button:focus {
    border-color: var(--hover);
    color: #fff;
  }

  button {
    background: none;
    border: 2px solid;
    font: inherit;
    line-height: 1;
    margin: 0.5em;
    padding: 1em 2em;
  }


  @import url(https://fonts.googleapis.com/css?family=Titillium+Web:300);

  .fa-2x {
    font-size: 2em;
  }

  .fa {
    position: relative;
    display: table-cell;
    width: 60px;
    height: 36px;
    text-align: center;
    vertical-align: middle;
    font-size: 20px;
  }


  .main-menu:hover,
  nav.main-menu.expanded {
    width: 250px;
    overflow: visible;
  }

  .main-menu {
    background: #212121;
    border-right: 1px solid #e5e5e5;
    position: fixed;
    top: 0;
    bottom: 0;
    height: 100%;
    left: 0;
    width: 60px;
    overflow: hidden;
    -webkit-transition: width .05s linear;
    transition: width .05s linear;
    -webkit-transform: translateZ(0) scale(1, 1);
    z-index: 1000;
  }

  .main-menu>ul {
    margin: 7px 0;
  }

  .main-menu li {
    position: relative;
    display: block;
    width: 250px;
  }

  .main-menu li>a {
    position: relative;
    display: table;
    border-collapse: collapse;
    border-spacing: 0;
    color: #999;
    font-family: arial;
    font-size: 14px;
    text-decoration: none;
    -webkit-transform: translateZ(0) scale(1, 1);
    -webkit-transition: all .1s linear;
    transition: all .1s linear;

  }

  .main-menu .nav-icon {
    position: relative;
    display: table-cell;
    width: 60px;
    height: 36px;
    text-align: center;
    vertical-align: middle;
    font-size: 18px;
  }

  .main-menu .nav-text {
    position: relative;
    display: table-cell;
    vertical-align: middle;
    width: 190px;
    font-family: 'Titillium Web', sans-serif;
  }

  .main-menu>ul.logout {
    position: absolute;
    left: 0;
    bottom: 0;
  }

  .no-touch .scrollable.hover {
    overflow-y: hidden;
  }

  .no-touch .scrollable.hover:hover {
    overflow-y: auto;
    overflow: visible;
  }

  a:hover,
  a:focus {
    text-decoration: none;
  }

  nav {
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    -o-user-select: none;
    user-select: none;
  }

  nav ul,
  nav li {
    outline: 0;
    margin: 0;
    padding: 0;
  }

  .main-menu li:hover>a,
  nav.main-menu li.active>a,
  .dropdown-menu>li>a:hover,
  .dropdown-menu>li>a:focus,
  .dropdown-menu>.active>a,
  .dropdown-menu>.active>a:hover,
  .dropdown-menu>.active>a:focus,
  .no-touch .dashboard-page nav.dashboard-menu ul li:hover a,
  .dashboard-page nav.dashboard-menu ul li.active a {
    color: #fff;
    background-color: #000000;
  }

  .area {
    float: left;
    background: #e2e2e2;
    width: 100%;
    height: 100%;
  }

  @font-face {
    font-family: 'Titillium Web';
    font-style: normal;
    font-weight: 300;
    src: local('Titillium WebLight'), local('TitilliumWeb-Light'), url(http://themes.googleusercontent.com/static/fonts/titilliumweb/v2/anMUvcNT0H1YN4FII8wpr24bNCNEoFTpS2BTjF6FB5E.woff) format('woff');
  }

  .timelayn,
  .buttons {
    margin-left: 10vh;
    overflow-x: hidden;
  }

  .middlehb {
    margin-left: 2vw;
  }

  .main-menu {
    overflox-y: show;
  }
</style>
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic'
  rel='stylesheet' type='text/css'>
<!-- The Timeline -->
<br>
<br>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<nav class="main-menu">
  <ul>
    <li>
      <a href="./pages/changepassword.php">
        <i class="fa fas fa-cog fa-1.5x"></i>
        <span class="nav-text">
          Change Password
        </span>
      </a>
    </li>
    <hr>
    <li>
      <a href="./index.php?page=announcements">
        <i class="fa fas fa-bell fa=1/5x"></i>
        <span class="nav-text">
          Announcements
        </span>
      </a>
    </li>
    <hr>
    <li>
      <a href="./index.php?page=roadmap">
        <i class="fa fas fa-road fa-1.5x"></i>
        <span class="nav-text">
          Roadmaps
        </span>
      </a>
    <hr>
  </ul>

  <ul class="logout">
    <?php
      
      $permission = $_SESSION["permission"];
      if($permission == 1) {
        echo '
            <li>
          <a href="./admin">
            <i class="fa fas fa-key fa-1.5x"></i>
            <span class="nav-text">
              Admin Page
            </span>
          </a>
        </li>
        ';
      }
    ?>
    <li>
      <a href="./messages.php">
        <i class="fa fas fa-mail-bulk fa-1.5x"></i>
        <span class="nav-text">
          Message
        </span>
      </a>
    </li>
    <li>
      <a href="./determination/user/logoutsystem.php">
        <i class="fa fad fa-sign-out-alt fa-1.5x"></i>
        <span class="nav-text">
          Logout
        </span>
      </a>
    </li>
  </ul>
</nav>
<div class="timelayn">
  <h1 class="center">
    <?php 
        if(isset($_GET["id"])) {
            $id = $_GET["id"];
        }
        else {
            $id = 1;
        }
        // $announcementNameSql = mysqli_query($conn,"SELECT * FROM `announcements` WHERE `id`='$id'");
        // $announcement = mysqli_fetch_array($announcementNameSql);
        echo $_SESSION["username"] . "'s Announcements";
    ?>
  </h1>
  <ul class="a">

    <?php
        include("./settings/connection.php");
        $announcements = mysqli_query($conn,"SELECT * FROM `announcements`");
        while($announcementrow = mysqli_fetch_array($announcements)) {
            echo '<li class="has-subnav">
            <a href="index.php?page=roadmap&id='.$announcementrow["id"].'">
            <i class="fa fas fa-bell fa-1.5x"></i>
            <span class="nav-text">
            '. $announcementrow["content"] .'
            </span>
            </a>
            </li>';
        }
   ?>
  </ul>
</div>