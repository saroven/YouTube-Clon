<?php
    require_once 'include/header.php';
    require_once 'include/classes/LikedVideosProvider.php';

    if (!User::isLoggedIn()){
        header("location: signIn.php");
    }
    $likedVideosProvider = new LikedVideosProvider($conn, $userLoggedInObj);
    $videos = $likedVideosProvider->getVideos();
    $videoGrid = new VideoGrid($conn, $userLoggedInObj);

?>
<div class="largeVideoGridContainer">
    <?php
        if (sizeof($videos) > 0){
            echo $videoGrid->createLarge($videos, "Videos that you have liked", false);
        }else{
            echo "No videos to show";
        }
    ?>
</div>

<?php require_once  "include/footer.php" ?>
