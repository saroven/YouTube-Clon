<?php

class ProfileData
{
    private $conn, $profileUserObj;

    public function __construct($conn, $profileUsername)
    {
        $this->conn =  $conn;
        $this->profileUserObj = new User($this->conn, $profileUsername);
    }

    public function getProfileUsername()
    {
        return $this->profileUserObj->getUserName();
    }

    public function getProfileUserObj()
    {
        return $this->profileUserObj;
    }

    public function usersExist()
    {
        $query = $this->conn->prepare("SELECT * FROM users WHERE username=:username");
        $username = $this->getProfileUsername();
        $query->bindParam(":username", $username);
        $query->execute();

        return $query->rowCount() != 0;
    }

    public function getCoverPhoto()
    {
        return "assets/images/coverPhotos/default-cover-photo.jpg";
    }

    public function getProfileUserFullName()
    {
        return $this->profileUserObj->getName();
    }
    public function getProfilePic()
    {
        return $this->profileUserObj->getProfilePic();
    }
    public function getSubscriberCount()
    {
        return $this->profileUserObj->getSubscriberCount();
    }
    public function getUserVideos()
    {
        $query = $this->conn->prepare("SELECT * FROM videos WHERE uploadBy=:uploadedBy ORDER BY uploadDate DESC");
        $profileUsername = $this->getProfileUsername();
        $query->bindParam(":uploadedBy", $profileUsername);
        $query->execute();

        $videos = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)){
            $videos[] = new Video($this->conn, $row, $this->profileUserObj->getUserName());
        }
        return $videos;
    }
}