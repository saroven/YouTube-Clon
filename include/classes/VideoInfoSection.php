<?php

class VideoInfoSection
{
    private $conn, $video, $userLoggedInObj;

    public function __construct($conn, $video, $userLoggedInObj)
    {
        $this->conn = $conn;
        $this->video = $video;
        $this->userLoggedInObj = $userLoggedInObj;
    }

    public function create()
    {
        return $this->createPrimaryInfo(). $this->createSecondaryInfo();
    }

    public function createPrimaryInfo()
    {
        $title = $this->video->getTitle();
        $views = $this->video->getViews();
        return "<div class='videoInfo'> 
                    <h1>$title</h1> 
                    <div class='bottomSection'>
                        <span class='videoCount'>$views</span>
                    </div>
                </div>";
    }
    public function createSecondaryInfo()
    {

    }
}

?>