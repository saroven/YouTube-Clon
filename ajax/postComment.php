<?php
    require '../include/config.php';
    require '../include/classes/User.php';
    require '../include/classes/Comment.php';

    if (isset($_POST['commentText']) && isset($_POST['postedBy']) && isset($_POST['videoId'])){

        $userLoggedInObj = new User($conn, $_SESSION['username']);

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
        $comment = new Comment($conn, $conn->lastInsertId(), $userLoggedInObj, $videoId);
        echo $comment->create();
    }else{
        echo "One or more parameter are not passed into the postComment.php file!";
    }
?>