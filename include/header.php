<?php
require_once "include/config.php";
require_once "include/classes/ButtonProvider.php";
require_once "include/classes/User.php";
require 'include/classes/Video.php';
require 'include/classes/VideoGrid.php';
require 'include/classes/VideoGridItem.php';
require 'include/classes/SubscriptionProvider.php';
require 'include/classes/NavigationMenuProvider.php';

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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" >
    <link rel="stylesheet" href="./assets/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" ></script>
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
       <?php echo ButtonProvider::createUserProfileNavigationButton($conn, $userLoggedInObj->getUserName()) ?>
</div>
</div>
<div class="sideNavContainer" style="display:none;">
    <?php
        $navigationProvider = new NavigationMenuProvider($conn, $userLoggedInObj);
        echo $navigationProvider->create();
    ?>
</div>
<div class="mainSectionContainer">
   <div class="mainContentContainer">
