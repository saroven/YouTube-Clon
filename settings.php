<?php
require_once 'include/header.php';
require_once 'include/classes/Account.php';
require_once 'include/classes/FormValidation.php';
require_once 'include/classes/Constants.php';
if (!User::isLoggedIn()){
    header("location: signIn.php");
}
?>

<div class="settingsContainer column">
    <div class="formSection">

    </div>
</div>
<?php require_once 'include/footer.php'; ?>