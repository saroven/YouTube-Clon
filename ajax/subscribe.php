<?php
    require '../include/config.php';

    if (isset($_POST['userTo']) && isset($_POST['userFrom'])){
        echo "all okay";
    }else{
        echo "One or more parameter are not passed into the subscribe.php file!";
    }
?>