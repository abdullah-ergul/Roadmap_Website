<?php
    include("../../settings/connection.php");
    session_start();
    if(!isset($_SESSION["id"])) {
        header("Location:../../");
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Delete a Alt Roadmap</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

     
        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-5 col-lg-9 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <!-- <div class="col-lg-6 d-none d-lg-block bg-password-image"></div> -->
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                    </div>
                                    <!-- 
                                        id
                                        roadmap_id
                                        name
                                        row_number
                                        short_content
                                        content
                                        type
                                     -->
                                    <form class="user" action="../determination/roadmaps/DeleteAltRoadmapSystem.php" method="POST">
                                        <div class="form-group">
                                            <label for="">Roadmap ID</label>
                                            <input type="text" class="form-control form-control-user" name="id" placeholder="Insert Roadmap's ID">
                                        </div>
                                        <button class="btn btn-primary" type="submit">Delete</button>
                                    </form>
                                    <hr>
                                </div>
                                <table class="table">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">name</th>
      <th scope="col">Roadmap</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    $sessionid = $_SESSION["id"];
    $users = mysqli_query($conn, "SELECT * FROM `altroadmaps`");
    while($userrow = mysqli_fetch_array($users)) {
        $roadmapid = $userrow["roadmap_id"];
        $roadmapsql = mysqli_query($conn,"SELECT * FROM `roadmaps` WHERE `id`='$roadmapid'");
        $roadmaprow = mysqli_fetch_array($roadmapsql); 
        echo '
        <tr>
      <th scope="row">'. $userrow["id"] .'</th>
      <td>'. $userrow["name"] .'</td>
      <td>'. $roadmaprow["name"] .'</td>
    </tr>
  
        ';
    }
    ?>
  </tbody>
</table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

</body>

</html>