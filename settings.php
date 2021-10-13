<?php
require_once 'include/header.php';
require_once 'include/classes/Account.php';
require_once 'include/classes/FormValidation.php';
require_once 'include/classes/Constants.php';
require_once 'include/classes/SettingsFormProvider.php';
if (!User::isLoggedIn()){
    header("location: signIn.php");
}
$settingsFormProvider = new SettingsFormProvider();
?>

<div class="settingsContainer column">
    <div class="formSection">
        <?= $settingsFormProvider->createUserDetailsForm(); ?>
    </div>
</div>
<?php require_once 'include/footer.php'; ?>