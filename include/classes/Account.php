<?php

class Account
{
    private $conn;
    private $errors = array();
    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    public function login($un, $ps){
        $ps = hash('sha512', $ps);
        $query = $this->conn->prepare("SELECT * FROM users WHERE username = :un AND password = :ps");
        $query->bindParam(":un", $un);
        $query->bindParam(":ps", $ps);

        $query->execute();
        if ($query->rowCount() == 1){
            return true;
        }else{
            array_push($this->errors, Constants::$loginFailed);
            return false;
        }
    }
    public function register($fn, $ln, $un, $em, $ps, $ps2)
    {
        $this->validateFirstName($fn);
        $this->validateLastName($ln);
        $this->validateUsername($un);
        $this->validateEmail($em);
        $this->validatePassword($ps, $ps2);

        if(empty($this->errors)){
            return $this->insertUserData($fn, $ln, $un, $em, $ps);
        }else{
            return false;
        }
    }

    public function updateDetails($fn, $ln, $em, $un)
    {
        $this->validateFirstName($fn);
        $this->validateLastName($ln);
        $this->validateNewEmail($em, $un);

        if (empty($this->errors)){
            $query = $this->conn->prepare("UPDATE users SET fname=:fn, lname=:ln, email=:em WHERE username=:un");
            $query->bindParam(":fn", $fn);
            $query->bindParam(":ln", $ln);
            $query->bindParam(":em", $em);
            $query->bindParam(":un", $un);

            return $query->execute();
        }else{
            return false;
        }
    }
    public function insertUserData($fn, $ln, $un, $em, $ps){
        $ps = hash('sha512', $ps);
        $pp = 'assets/images/profilePictures/default.png';
        $query = $this->conn->prepare("INSERT INTO users (fname, lname, email, username, password,profilePic) 
                                        VALUES (:fn, :ln, :em, :un, :ps, :pp)");
        $query->bindParam(':fn', $fn);
        $query->bindParam(':ln', $ln);
        $query->bindParam(':em', $em);
        $query->bindParam(':un', $un);
        $query->bindParam(':ps', $ps);
        $query->bindParam(':pp', $pp);

        return $query->execute();
    }

    private function validateFirstName($name)
    {
        if (strlen($name) > 25 || strlen($name) < 2){
            array_push($this->errors, Constants::$firstNameCharacters);
        }
    }
    private function validateLastName($name)
    {
        if (strlen($name) > 25 || strlen($name) < 2){
            array_push($this->errors, Constants::$lastNameCharacters);
        }
    }
    private function validateUsername($username)
    {
        if (strlen($username) > 25 || strlen($username) < 5){
            array_push($this->errors, Constants::$usernameCharacters);
            return;
        }
        $query = $this->conn->prepare("SELECT * FROM users WHERE username=:un");
        $query->bindParam(":un", $username);
        $query->execute();
        if ($query->rowCount() != 0){
            array_push($this->errors, Constants::$usernameTaken);
        }
    }
    private function validateEmail($em)
    {
        if (!filter_var($em, FILTER_VALIDATE_EMAIL)) {
            array_push($this->errors, Constants::$invalidEmail);
            return;
        }
        $query = $this->conn->prepare("SELECT * FROM users WHERE email=:em");
        $query->bindParam(":em", $em);
        $query->execute();
        if ($query->rowCount() != 0){
            array_push($this->errors, Constants::$emailTaken);
        }
    }
    private function validateNewEmail($em, $un)
    {
        if (!filter_var($em, FILTER_VALIDATE_EMAIL)) {
            array_push($this->errors, Constants::$invalidEmail);
            return;
        }
        $query = $this->conn->prepare("SELECT * FROM users WHERE email=:em AND username !=:un");
        $query->bindParam(":un", $un);
        $query->bindParam(":em", $em);
        $query->execute();
        if ($query->rowCount() != 0){
            array_push($this->errors, Constants::$emailTaken);
        }
    }
    private function validatePassword($ps, $ps2)
    {
        if ($ps != $ps2){
            array_push($this->errors, Constants::$passwordNotMatch);
            return;
        }
        if (strlen($ps) > 25 || strlen($ps) < 6){
            array_push($this->errors, Constants::$passwordCharacter);
        }
    }
    public function getError($err)
    {
        if (in_array($err, $this->errors)){
            return "<span class='errorMessage'>$err</span>";
        }
    }
    public function getFirstError()
    {
        if (!empty($this->errors)){
            return $this->errors[0];
        }else{
            return "";
        }
    }

}