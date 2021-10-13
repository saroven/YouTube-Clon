<?php
require_once 'include/classes/ProfileData.php';

class ProfileGenerator
{
    private $conn, $userLoggedInObj, $profileData;

    public function __construct($conn, $userLoggedInObj, $profileUsername)
    {
        $this->conn =  $conn;
        $this->userLoggedInObj = $userLoggedInObj;
        $this->profileData = new ProfileData($this->conn, $profileUsername);
    }

    public function create()
    {
        $profileUsername = $this->profileData->getProfileUsername();
        if (!$this->profileData->usersExist()){
        die("User Not Found");
        }
        $coverPhotoSection = $this->createCoverPhotoSection();
        $headerSection = $this->createHeaderSection();
        $tabsSection = $this->createTabsSection();
        $contentSection = $this->createContentSection();
        return "<div class='profileContainer'>
                    $coverPhotoSection
                    $headerSection
                    $tabsSection
                    $contentSection
                </div>";
    }

    public function createCoverPhotoSection()
    {
        $coverPhoto =  $this->profileData->getCoverPhoto();
        $name = $this->profileData->getProfileUserFullName();

        echo "<div class='coverPhotoContainer'>
                    <img src='$coverPhoto' class='coverPhoto'>
                    <span class='channelName'>$name</span>
                </div>";
    }
    public function createHeaderSection()
    {
        $profileImage = $this->profileData->getProfilePic();
        $name = $this->profileData->getProfileUserFullName();
        $subscriberCount = $this->profileData->getSubscriberCount();

        $button = $this->createHeaderButton();

        echo "<div class='profileHeader'>
                    <div class='userInfoContainer'>
                        <img src='$profileImage' class='profileImage'>
                        <div class='userInfo'>
                            <span class='title'>$name</span>
                            <span class='subscriberCount'>$subscriberCount Subscribers</span>
                        </div>
                    </div>
                    <div class='buttonContainer'>
                        <div class='buttonItem'>
                          $button
                        </div>
                    </div>
                </div>";
    }
    public function createTabsSection()
    {
        echo "<ul class='nav nav-tabs' role='tablist'>
                  <li class='nav-item'>
                    <a class='nav-link active' id='videos-tab' data-toggle='tab' 
                    href='#videos' role='tab' aria-controls='videos' aria-selected='true'>VIDEOS</a>
                  </li>
                  <li class='nav-item'>
                    <a class='nav-link' id='about-tab' data-toggle='tab' 
                    href='#about' role='tab' aria-controls='about' aria-selected='false'>ABOUT</a>
                  </li>
                </ul>";
    }
    public function createContentSection()
    {
        echo "<div class='tab-content channelContent'>
                  <div class='tab-pane fade show active' id='videos' role='tabpanel' aria-labelledby='videos-tab'>
                    videos tab
                  </div>
                  <div class='tab-pane fade' id='about' role='tabpanel' aria-labelledby='about-tab'>
                    About tab
                  </div>
                </div>";
    }

    public function createHeaderButton()
    {
        if ($this->userLoggedInObj->getUserName() == $this->profileData->getProfileUsername()){
            return "";
        }else{
            return ButtonProvider::createSubscriberButton($this->conn,
                                                    $this->profileData->getProfileUserObj(),
                                                    $this->userLoggedInObj);
        }
    }
}