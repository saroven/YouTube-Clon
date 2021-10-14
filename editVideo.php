<?php
require_once "include/header.php";
require_once 'include/classes/VideoPlayer.php';
require_once 'include/classes/VideoDetailsFormProvider.php';
require_once 'include/classes/VideoUploadData.php';
require_once 'include/classes/selectThumbnail.php';

if (!User::isLoggedIn()) header("location: signIn.php");

if (!isset($_GET['videoId']) || $_GET['videoId'] == ""){
    die("No video selected!");
}

$video = new Video($conn, $_GET['videoId'], $userLoggedInObj);
if ($video->getUploadedBy() != $userLoggedInObj->getUserName()){
    die("Not your video");
}

if (isset($_POST['save'])){
    $videUpdateData = new VideoUpdateData(
            null,
        $_POST['title'],
        $_POST['description'],
        $_POST['privacy'],
        $_POST['category'],
        $userLoggedInObj->getUserName()
    );

    if($videUpdateData->updateDetails($conn, $videoId)){
        //success
        $detailsMessage = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                              <strong>SUCCESS!</strong> Details updated successfully!
                              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                              </button>
                            </div>";

    }else{
        //update failed

        $detailsMessage = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                              <strong>ERROR!</strong> Something Went Wrong!
                              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                              </button>
                            </div>";
    }

}
?>

<div class="editVideoContainer column">
    <div class="topSection">
        <?php
            $videoPlayer = new VideoPlayer($video);
            echo $videoPlayer->create(false);

            $selectThumbnail = new selectThumbnail($conn,$video);
            echo $selectThumbnail->create();
        ?>
    </div>
    <div class="bottomSection">
        <?php
            $videoDetailsFormProvider = new VideoDetailsFormProvider($conn);
            echo $videoDetailsFormProvider->createEditDetailsForm($video);
        ?>
    </div>
</div>
<script src="assets/js/editVideoActions.js"></script>