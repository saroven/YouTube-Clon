<?php

class VideoGrid
{
    private $conn, $userLoggedInObj;
    private $largeMode = false;
    private $gridClass = "videoGrid";
    public  function __construct($conn, $userLoggedInObj){
        $this->conn = $conn;
        $this->userLoggedInObj = $userLoggedInObj;
    }
    public function create($videos, $title, $showFilter){
        if ($videos == null){
            $gridItems = $this->generateItems();
        }else{
            $gridItems = $this->generateItemsFromVideos($videos);
        }
        $header = "";
        if ($title != null){
            $header = $this->createGridHeader($title, $showFilter);
        }
        return "$header
                <div class='$this->gridClass'>
                    $gridItems
                </div>";
    }
    public function generateItems(){
        $query = $this->conn->prepare("SELECT * FROM videos ORDER BY rand() LIMIT 15");
        $query->execute();
        $elementHtml = "";
        while ($row = $query->fetch(PDO::FETCH_ASSOC)){
            $video = new Video($this->conn, $row, $this->userLoggedInObj);
            $item = new VideoGridItem($video, $this->largeMode);
            $elementHtml .= $item->create();
        }
        return $elementHtml;
    }
    public function generateItemsFromVideos($videos){
        $elementHtml = "";
        foreach ($videos as $video){
            $item = new VideoGridItem($video,$this->largeMode);
            $elementHtml .= $item->create();
        }
        return $elementHtml;
    }
    public function createGridHeader($title, $showFilter){
        $filter = "";
        return "<div class='videoGridHeader'>
                   <div class='left'>$title</div>
                   $filter
                </div>";
    }
    public function createLarge($videos, $title, $showFilter){
        $this->gridClass .= ' large';
        $this->largeMode = true;
        return $this->create($videos, $title, $showFilter);
    }
}