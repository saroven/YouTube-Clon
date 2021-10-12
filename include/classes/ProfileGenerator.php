<?php

class ProfileGenerator
{
    private $conn, $userLoggedInObj, $profileUsername;

    public function __construct($conn, $userLoggedInObj, $profileUsername)
    {
        $this->conn =  $conn;
        $this->userLoggedInObj = $userLoggedInObj;
        $this->profileUsername = $profileUsername;
    }

    public function create()
    {
        
    }
}