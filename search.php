<?php
require_once 'include/header.php';
require_once 'include/classes/SearchResultsProvider.php';

if (!isset($_GET['term']) || $_GET['term'] == ""){
    echo 'You must enter search term';
    die();
}
$term = $_GET['term'];

if (!isset($_GET['orderBy']) || $_GET['orderBy'] == "views"){
    $orderBy = "views";
}else{
    $orderBy = "uploadDate";
}
$searchResultProvider = new SearchResultsProvider($conn, $userLoggedInObj);
$videos = $searchResultProvider->getVideos($term, $orderBy);

$videoGrid = new VideoGrid($conn, $userLoggedInObj);
?>
<div class="largeVideoGridContainer">
    <?php
        if (sizeof($videos) > 0){
            echo $videoGrid->createLarge($videos, sizeof($videos) . " videos found", true);
        }else{
            echo "No results found!";
        }
    ?>
</div>
<?php
require_once 'include/footer.php';
?>