<?php
require_once 'include/header.php';

if (!isset($_GET['term']) || $_GET['term'] == ""){
    echo 'You must enter search term';
    die();
}
$term = $_GET['term'];

if (!isset($_GET['orderBy']) || $_GET['orderBy'] == "views"){
    $orderBy = "views";
}else{
    $orderBy = "uploadDate";
}
?>

<?php
require_once 'include/footer.php';
?>