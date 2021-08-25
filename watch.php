<?php
require 'include/header.php';
if (!isset($_GET['id']) || empty($_GET['id'])){
    die("No url passed into page");
}

?>


<?php require 'include/footer.php'; ?>
