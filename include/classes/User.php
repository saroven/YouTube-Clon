<?php

class User
{
    private $conn, $sqlData;
    public function __construct($conn, $username)
    {
        $this->conn = $conn;

        $query = $this->conn->prepare("SELECT * FROM users WHERE username=:un");
        $query->bindParam(":un", $username);
        $query->execute();

        $this->sqlData = $query->fetch(PDO::FETCH_ASSOC);
    }

    public function getUserName()
    {
        return $this->sqlData['username'];
    }
    public function getName()
    {
        return $this->sqlData['fname']." ".$this->sqlData['lname'];
    }
    public function getFirstName()
    {
        return $this->sqlData['fname'];
    }
    public function getLastName()
    {
        return $this->sqlData['lname'];
    }
    public function getEmail()
    {
        return $this->sqlData['email'];
    }
    public function getProfilePic()
    {
        return $this->sqlData['profilePic'];
    }
    public function getSignUpDate()
    {
        return $this->sqlData['signUpDate'];
    }


}