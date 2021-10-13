<?php

class selectThumbnail
{
    private $conn, $video;

    public function __construct($conn, $video)
    {
        $this->conn = $conn;
        $this->video = $video;
    }

    public function create()
    {
        $thumbnailData = $this->getThumbnailData();
    }
    private function getThumbnailData(){
        $data = array();

       $query =  $this->conn->prepare("SELECT * FROM thumbnails WHERE videoid=:videoId");
       $videoId = $this->video->getId();
       $query->bindParam(":videoId", $videoId);
       $query->execute();
       while($row = $query->fetch(PDO::FETCH_ASSOC)){
           $data[] = $row;
       }
       return $data;
    }
}