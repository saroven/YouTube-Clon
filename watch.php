<?php
require 'include/header.php';
require 'include/classes/Video.php';
if (!isset($_GET['id']) || empty($_GET['id'])){
    die("No url passed into page");
}
$video  = new Video($conn, $_GET["id"], $userLoggedInObj);
echo $video->getTitle();

$video->incrementViews();
?>


<?php require 'include/footer.php'; ?>
