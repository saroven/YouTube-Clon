<?php
ob_start(); //turn on output buffering
session_start(); //starting session
date_default_timezone_set('Asia/Dhaka'); //Bangladeshi time zone setup

try {
    $conn = new PDO('mysql:dbname=VideoPipe;host:localhost', 'root', '');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
}catch (PDOException $e){
    echo "Connection Failed ".$e->getMessage() ;
}