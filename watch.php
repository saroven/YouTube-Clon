<?php
require 'include/header.php';
require 'include/classes/VideoPlayer.php';
if (!isset($_GET['id']) || empty($_GET['id'])){
    die("No url passed into page");
}
$video  = new Video($conn, $_GET["id"], $userLoggedInObj);
echo $video->getTitle();

$video->incrementViews();
?>

<div class="watchLeftColumn">
   <?php
   $videoPlayer = new VideoPlayer($video);
   echo $videoPlayer->create(true);
   ?>
</div>


<?php require 'include/footer.php'; ?>
