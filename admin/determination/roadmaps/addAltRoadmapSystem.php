<?php
include("../../../settings/connection.php");

$altroadmapname = $_GET["altroadmapname"];
$shortdesc = strval($_GET["shortdesc"]);
$roadmaptype = $_GET["roadmaptype"];
$longdesc = strval($_GET["longdesc"]);
$roadmapid = $_GET["mainroadmapid"];

// if($roadmaptype == 1) {
// $url = $longdesc;
//     $parts = parse_url($url);
//     if (isset($parts['query'])) {
//         parse_str($parts['query'], $query);
//         if (isset($query['v'])) {
//             $urlid = $query['v'];
//         }
//     }
// $longdesc = $urlid;
// }

$sql = mysqli_query($conn,"INSERT INTO `altroadmaps` (`name`,`short_content`,`content`,`type`,`roadmap_id`) VALUES ('$altroadmapname', '$shortdesc', '$longdesc', '$roadmaptype', '$roadmapid')");
header("Location: ../../");
?>
