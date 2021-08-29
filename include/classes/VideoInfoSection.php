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
        $description = $this->video->getDescription();
        $uploadDate = $this->video->getUploadDate();
        $uploadedBy = $this->video->getUploadedBy();
        $profileButton = ButtonProvider::createUserProfileButton($this->conn, $uploadedBy);

        if ($uploadedBy == $this->userLoggedInObj->getUserName())
        {
            $actionButton = ButtonProvider::createEditVideoButton($this->video->getId());
        }else{
            $userToObj = new User($this->conn, $uploadedBy);
            $actionButton = ButtonProvider::createSubscriberButton($this->conn, $userToObj, $this->userLoggedInObj);
        }



        return "<div class='secondaryInfo'>
                    <div class='topRow'>
                            $profileButton
                        <div class='uploadInfo'>
                            <span class='owner'>
                                <a href='profile.php?username=$uploadedBy'>
                                    $uploadedBy
                                </a>
                            </span>
                            <span class='date'>Published on: $uploadDate</span>
                        </div>
                        $actionButton
                    </div>
                    <div class='descriptionContainer'>$description</div>
                </div>";
    }
}

?>