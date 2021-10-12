<?php
require_once 'include/header.php';
require_once 'include/classes/ProfileGenerator.php';

if (isset($_GET['username']) && $_GET['username'] != ""){
    $profileUsername = $_GET['username'];
}else{
    die("Channel not found!");
}
$profileGenerator = new ProfileGenerator($conn, $userLoggedInObj, $profileUsername);
$profileGenerator->create();
?>

<?php
require_once 'include/footer.php';
?>
