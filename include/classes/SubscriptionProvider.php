<?php

class SubscriptionProvider
{
    private $conn, $userLoggedInObj;
    public function __construct($conn, $userLoggedInObj)
    {
        $this->conn = $conn;
        $this->userLoggedInObj = $userLoggedInObj;
    }

    public function getVideos()
    {
        $videos = array();
        $subscriptions = $this->userLoggedInObj->getSubscriptions();
        if (sizeof($subscriptions) > 0){
            $condition = "";
            $i = 0;
            while ($i < sizeof($subscriptions)){
                if ($i == 0){
                    $condition .= "WHERE uploadBy=?";
                }else{
                    $condition .= " OR uploadBy=?";
                }
                $i++;
            }
            $videoSql = "SELECT * FROM videos $condition ORDER BY uploadDate DESC";
            $videoQuery = $this->conn->prepare($videoSql);
            $i = 1;
            foreach ($subscriptions as $sub){
                $username = $sub->getUserName();
                $videoQuery->bindValue($i, $username);
                $i++;
            }
            $videoQuery->execute();
            while ($row = $videoQuery->fetch(PDO::FETCH_ASSOC)){
                $video = new Video($this->conn, $row, $this->userLoggedInObj);
                array_push($videos, $video);
            }
        }
        return $videos;
    }
}