<?php
require_once "include/header.php";
require_once 'include/classes/VideoPlayer.php';
require_once 'include/classes/VideoDetailsFormProvider.php';
require_once 'include/classes/VideoUploadData.php';

if (!User::isLoggedIn()) header("location: signIn.php");

if (!isset($_GET['videoId']) || $_GET['videoId'] == ""){
    die("No video selected!");
}

$video = new Video($conn, $_GET['videoId'], $userLoggedInObj);
if ($video->getUploadedBy() != $userLoggedInObj->getUserName()){
    die("Not your video");
}