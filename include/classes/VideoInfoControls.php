<?php
require 'include/classes/ButtonProvider.php';

class VideoInfoControls
{
    private $video, $userLoggedInObj;

    public function __construct($video, $userLoggedInObj)
    {
        $this->video = $video;
        $this->userLoggedInObj = $userLoggedInObj;
    }
    private function createLikeButton(){
        $text = $this->video->getLikes();
        $videoId = $this->video->getId();
        $action = "likeVideo(this, $videoId)";
        $class = "likeButton";
        $imageSrc =  'assets/images/icons/thumb-up.png';

        //change like button if already liked..
        return ButtonProvider::createButton($text, $imageSrc, $action,$class);
    }
    private function createDisLikeButton(){
        return ButtonProvider::createButton('Dislike', '', '','');
    }
    public function create()
    {
        $likeButton = $this->createLikeButton();
        $disLikeButton = $this->createDisLikeButton();
        return "<div class='controls'>$likeButton $disLikeButton</div>";
    }
}