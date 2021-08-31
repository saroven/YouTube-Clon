<?php
    require '../include/config.php';

    if (isset($_POST['commentText']) && isset($_POST['postedBy']) && isset($_POST['videoId'])){
        $query = $conn->prepare("INSERT INTO comments(postedBy, videoId, responseTo, body)
                                        VALUES (:postedBy, :videoId, :responseTo, :body)");
        $postedBy = $_POST['postedBy'];
        $videoId = $_POST['videoId'];
        $responseTo = $_POST['responseTo'];
        $commentText = $_POST['commentText'];

        $query->bindParam(":postedBy", $postedBy);
        $query->bindParam(":videoId", $videoId);
        $query->bindParam(":responseTo", $responseTo);
        $query->bindParam(":body", $commentText);

        $query->execute();
        //return new comment
    }else{
        echo "One or more parameter are not passed into the subscribe.php file!";
    }
?>