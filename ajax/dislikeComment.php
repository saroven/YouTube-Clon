<?php
require '../include/config.php';
require '../include/classes/Comment.php';
require '../include/classes/User.php';

$videoId =  $_POST['videoId'];
$commentId =  $_POST['commentId'];
$username = $_SESSION['username'];

$userloggedInObj = new User($conn,$username);

$comment = new Comment($conn,$commentId, $userloggedInObj, $videoId);

echo $comment->disLike();
?>