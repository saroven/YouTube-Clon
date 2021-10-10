<?php
require_once "include/config.php";
//require_once "include/classes/ButtonProvider.php";
require_once "include/classes/User.php";
require 'include/classes/Video.php';
require 'include/classes/VideoGrid.php';
require 'include/classes/VideoGridItem.php';

$usernameLoggedIn = isset($_SESSION['username']) ? $_SESSION['username'] : "";
$userLoggedInObj = new User($conn, $usernameLoggedIn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>You Pipe</title>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
 <link rel="stylesheet" href="./assets/css/style.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
 <script src="./assets/js/commonAction.js"></script>
 <script src="./assets/js/userAction.js"></script>

</head>
<body>
  <div class="pageContainer">
    <div class="mastHeadContainer">
       <button class="navShowHide">
         <img src="./assets/images/icons/menu.png" alt="">
      </button>
      <a class="logoContainer" href="index.php">
         <img src="./assets/images/icons/youpipe.png" alt="Site logo" title="logo">
      </a>
      <div class="searchBarContainer">
        <form action="search.php" method="GET">
          <input type="text" class="searchBar" value="" name="term" placehoder="search...">
          <button class="searchBtn">
            <img src="./assets/images/icons/search.png" alt="Search Button" srcset="">
         </button>
      </form>
   </div>
   <div class="rightIcon">
     <a href="upload.php">
      <img src="./assets/images/icons/upload.png" alt="upload btn">
    </a>
   <a href="#">
      <img src="./assets/images/profilePictures/default.png" alt="Profile">
   </a>
</div>
</div>
<div class="sideNavContainer" style="display:none;">

</div>
<div class="mainSectionContainer">
   <div class="mainContentContainer">
