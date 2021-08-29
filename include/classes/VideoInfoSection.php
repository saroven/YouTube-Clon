<?php
require 'include/classes/VideoInfoControls.php';
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
        $videoInfoControls = new VideoInfoControls($this->video, $this->userLoggedInObj);
        $controls = $videoInfoControls->create();
        return "<div class='videoInfo'> 
                    <h1>$title</h1> 
                    <div class='bottomSection'>
                        <span class='videoCount'>$views Views</span>
                        $controls
                    </div>
                </div>";
    }
    public function createSecondaryInfo()
    {

    }
}

?>