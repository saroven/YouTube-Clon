<?php

class Account
{
    private $conn;
    private $errors = array();
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function register($fn, $ln, $un, $em, $ps, $ps2)
    {
        $this->validateFirstName($fn);
        $this->validateLastName($ln);
        $this->validateUsername($un);
        $this->validateEmail($em);
        $this->validatePassword($ps, $ps2);
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

}