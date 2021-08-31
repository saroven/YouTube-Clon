<?php

class CommentSection
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
        return $this->createCommentSection();
    }

    private function createCommentSection()
    {
        $numComments =  $this->video->getNumberOfComment();
        $postedBy = $this->userLoggedInObj->getUserName();
        $videoId = $this->video->getId();
        $profileButton = ButtonProvider::createUserProfileButton($this->conn, $postedBy);
        $commentAction = "postComment(this, \"$postedBy\", $videoId, null, \"comments\")";
        $commentButton = ButtonProvider::createButton('COMMENT', $commentAction, 'postComment', 'comment');

        //comment html

        return "<div class='commentSection'>
                    <div class='header'>
                        <span class='commentCount'>$numComments Comments</span>
                    </div>
                </div>";
    }
}

?>