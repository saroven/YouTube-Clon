<?php
    require_once 'include/header.php';

    $subscriptionProvider = new SubscriptionProvider($conn, $userLoggedInObj);
    $videos = $subscriptionProvider->getVideos();
    $videoGrid = new VideoGrid($conn, $userLoggedInObj);

?>
<div class="largeVideoGridContainer">
    <?php
        if (sizeof($videos) > 0){
            echo $videoGrid->createLarge($videos, "New from your subscription", false);
        }else{
            echo "No videos to show";
        }
    ?>
</div>

<?php require_once  "include/footer.php" ?>
