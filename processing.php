<?php
require 'include/header.php';
require 'include/classes/VideoUploadData.php';
require 'include/classes/VideoProcessor.php ';
if(!isset($_POST['upload'])){
    echo "No file selected";
    die();
}

// 1) Create file upload data
$videoUploadData = new VideoUploadData($_FILES["file"], $_POST["title"], $_POST["description"], $_POST["privacy"], $_POST["category"], "roven") ;
//2) Process video data (Upload)
$videoProcessor = new VideoProcessor($conn);
$wasSuccessull = $videoProcessor->upload($videoUploadData);
//3) Check if upload successful

