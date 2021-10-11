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
    public static function isLoggedIn(){
        return isset($_SESSION['username']) ? $_SESSION['username'] : "";
    }
    public function getUserName()
    {
        return isset($this->sqlData["username"]) ?  $this->sqlData["username"] : "" ;
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

    public function isSubscribedTo($userTo)
    {
        $username = $this->getUserName();
        $query = $this->conn->prepare("SELECT * FROM subscribers WHERE userTo=:userTo AND userFrom=:userFrom");
        $query->bindParam(":userTo",$userTo);
        $query->bindParam(":userFrom",$username);
        $query->execute();

        return $query->rowCount() > 0;
    }
    public function getSubscriberCount()
    {
        $username = $this->getUserName();
        $query = $this->conn->prepare("SELECT * FROM subscribers WHERE userTo=:userTo");
        $query->bindParam(":userTo",$username);
        $query->execute();

        return $query->rowCount();
    }

    public function getSubscriptions()
    {
        $query = $this->conn->prepare("SELECT userTo FROM subscribers WHERE userFrom=:userFrom");
        $username = $this->getUserName();
        $query->bindParam(":userFrom", $username);
        $query->execute();
        $subs = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)){
            $user = new User($this->conn, $row['userTo']);
            array_push($subs, $user);
        }
        return $subs;
    }


}