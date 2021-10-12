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
        die("Channel Not Found");
        }
    }
}