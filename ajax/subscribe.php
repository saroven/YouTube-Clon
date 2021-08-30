<?php
    require '../include/config.php';

    if (isset($_POST['userTo']) && isset($_POST['userFrom'])){

        $userTo = $_POST['userTo'];
        $userFrom = $_POST['userFrom'];

        //check if user is already subscribed
        $query = $conn->prepare("SELECT * FROM subscribers WHERE userTo=:userTo AND userFrom=:userFrom");
        $query->bindParam(":userTo", $userTo);
        $query->bindParam(":userFrom", $userFrom);
        $query->execute();
        if ($query->rowCount() == 0){
            //insert
            $query = $conn->prepare("INSERT INTO subscribers (userTo, userFrom) VALUES (:userTo, :userFrom)");
            $query->bindParam(":userTo", $userTo);
            $query->bindParam(":userFrom", $userFrom);
            $query->execute();
        }else{
            //delete
            $query = $conn->prepare("DELETE FROM subscribers WHERE userTo=:userTo AND userFrom=:userFrom");
            $query->bindParam(":userTo", $userTo);
            $query->bindParam(":userFrom", $userFrom);
            $query->execute();
        }
        //return new number of subscriber
        $query = $conn->prepare("SELECT * FROM subscribers WHERE userTo=:userTo");
        $query->bindParam(":userTo", $userTo);
        $query->execute();
        echo $query->rowCount();
    }else{
        echo "One or more parameter are not passed into the subscribe.php file!";
    }
?>