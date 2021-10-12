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
}