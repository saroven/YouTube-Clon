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

        $html = "";

        foreach ($thumbnailData as $data){
            $html .= $this->createThumbnail($data);
        }

        return "<div class='thumbnailItemsContainer'>
                    $html
                </div>";
    }

    private function createThumbnail($data)
    {
        $id = $data['id'];
        $url = $data['filePath'];
        $videoId = $data['videoid'];
        $selected = $data['selected'] == 1 ? "selected" : "";

        return "<div class='thumbnailItem $selected' onclick='setNewThumbnail($id, $videoId, this)'>
                    <img src='$url'>
                </div>";
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