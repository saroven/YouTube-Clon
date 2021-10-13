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

    }
    public function createContentSection()
    {

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