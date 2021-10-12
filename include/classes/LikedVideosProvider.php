<?php

class LikedVideosProvider
{
    private $conn, $userLoggedInObj;

    public function __construct($conn, $userLoggedInObj)
    {
        $this->conn = $conn;
        $this->userLoggedInObj = $userLoggedInObj;
    }
    public function getVideos(){
        $videos = array();
        $query = $this->conn->prepare("SELECT videoId FROM likes WHERE username=:username AND commentId=0
                                        ORDER BY id DESC");
        $username = $this->userLoggedInObj->getUserName();
        $query->bindParam(":username", $username);
        $query->execute();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)){
            $video = new Video($this->conn, $row['videoId'], $this->userLoggedInObj);
            array_push($videos, $video);
        }
        return $videos;
    }
}
?>