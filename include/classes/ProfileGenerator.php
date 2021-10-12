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

    }
    public function createTabsSection()
    {

    }
    public function createContentSection()
    {

    }
}