<?php
require 'ButtonProvider.php';

class CommentControls
{
    private $conn, $comment, $userLoggedInObj;

    public function __construct($conn, $comment, $userLoggedInObj)
    {
        $this->conn = $conn;
        $this->comment =$comment;
        $this->userLoggedInObj = $userLoggedInObj;
    }
    private function createLikeButton(){
//        $text = $this->comment->getLikes();
        $commentId = $this->comment->getId();
        $videoId = $this->comment->getVideoId();
        $action = "likeComment($commentId, this, $videoId)";
        $class = "likeButton";
        $imageSrc =  'assets/images/icons/thumb-up.png';

        //change like button if already liked..
        if ($this->comment->wasLikedBy()){
            $imageSrc =  'assets/images/icons/thumb-up-active.png';
        }
        return ButtonProvider::createButton("", $imageSrc, $action,$class);
    }
    private function createDisLikeButton(){
//        $text = $this->video->getDislikes();
        $commentId = $this->comment->getId();
        $videoId = $this->comment->getVideoId();
        $action = "dislikeComment($commentId, this, $videoId)";
        $class = "dislikeButton";
        $imageSrc = 'assets/images/icons/thumb-down.png';

        //change dislike button if already liked
        if ($this->comment->wasDislikedBy()){
            $imageSrc =  'assets/images/icons/thumb-down-active.png';
        }
        return ButtonProvider::createButton("", $imageSrc, $action,$class);
    }
    private function createReplyButton(){
        $text = "REPLY";
        $action = "toggleReply(this)";
        return ButtonProvider::createButton($text, null, $action, null);
    }
    private function createLikesCount(){
        $text = $this->comment->getLikes();
        if($text == 0) $text = '';
        return "<span class='liksCount'>$text</span>";
    }
    private function createReplySection(){

        return "";
    }

    public function create()
    {
        $replyButton = $this->createReplyButton();
        $likesCount = $this->createLikesCount();
        $likeButton = $this->createLikeButton();
        $disLikeButton = $this->createDisLikeButton();
        $replySection = $this->createReplySection();

        return "<div class='controls'>$likeButton $disLikeButton</div>";
    }
}