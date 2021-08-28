<?php
require '../include/config.php';
require '../include/classes/Video.php';
require '../include/classes/User.php';
$videoId =  $_POST['videoId'];
$username = $_SESSION['username'];

$userloggedInObj = new User($conn,$username);

$video = new Video($conn, $videoId, $userloggedInObj);

echo $video->like();
?>