<?php
    require_once 'include/header.php';
    require_once 'include/classes/TrendingProvider.php';

    $trendingProvider = new TrendingProvider($conn, $userLoggedInObj);
    $videos = $trendingProvider->getVideos();
    $videoGrid = new VideoGrid($conn, $userLoggedInObj);

?>
<div class="largeVideoGridContainer">
    <?php
        if (sizeof($videos) > 0){
            echo $videoGrid->createLarge($videos, "Trending videos uploaded in the last week", false);
        }else{
            print_r($videos);
            echo "No trending videos to show";
        }
    ?>
</div>

<?php require_once  "include/footer.php" ?>
