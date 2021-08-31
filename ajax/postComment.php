<?php
    require '../include/config.php';

    if (isset($_POST['commentText']) && isset($_POST['postedBy']) && isset($_POST['videoId'])){
        echo "success";
    }else{
        echo "One or more parameter are not passed into the subscribe.php file!";
    }
?>