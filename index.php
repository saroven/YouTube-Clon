<?php require 'include/header.php'; ?>

<?php
  if (isset($_SESSION['username'])){
      echo "Logged in as: ".$userLoggedInObj->getName();
  }else{
      echo "Not logged in.";
  }
?>
<?php require 'include/footer.php'; ?>
