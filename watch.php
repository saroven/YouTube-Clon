<?php
require 'include/header.php';
require 'include/classes/VideoPlayer.php';
require 'include/classes/VideoInfoSection.php';
require 'include/classes/CommentSection.php';

if (!isset($_GET['id']) || empty($_GET['id'])){
    die("No url passed into page");
}

$video  = new Video($conn, $_GET["id"], $userLoggedInObj);
$video->incrementViews();

?>
<script src="assets/js/videoPlayerAction.js"></script>
<script src="assets/js/commentAction.js"></script>
<div class="watchLeftColumn">
   <?php
   $videoPlayer = new VideoPlayer($video);
   echo $videoPlayer->create(true);

   $videoInfo = new VideoInfoSection($conn, $video, $userLoggedInObj);
   echo $videoInfo->create();

   $commentSection = new CommentSection($conn, $video, $userLoggedInObj);
   echo $commentSection->create();

   ?>
</div>
<div class="suggestions">

</div>

<?php require 'include/footer.php'; ?>
