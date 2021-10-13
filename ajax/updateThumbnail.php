<?php
require_once '../include/config.php';

if (isset($_POST['thumbnailId']) && isset($_POST['videoId']) ){
    $videoId = $_POST['videoId'];
    $thumbnailId = $_POST['thumbnailId'];
    //remove selected
    $query = $conn->prepare("UPDATE thumbnails SET selected=0 WHERE videoid=:videoId");
    $query->bindParam(":videoId",$videoId);
    $query->execute();

    //select new thumbnail
    $query = $conn->prepare("UPDATE thumbnails SET selected=1 WHERE id=:thumbnailId");
    $query->bindParam(":thumbnailId",$thumbnailId);
    $query->execute();
}else{
    echo "One or more parameter are not passed into the updateThumbnail.php file!";
}