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
        return "<div class='$this->gridClass'>
                
                </div>";
    }
}