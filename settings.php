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
        <?php
        echo $settingsFormProvider->createUserDetailsForm(
                $_POST['fname'] ?? $userLoggedInObj->getFirstName(),
            $_POST['lname'] ?? $userLoggedInObj->getLastName(),
            $_POST['email'] ?? $userLoggedInObj->getEmail()
        );
        echo $settingsFormProvider->createPasswordForm();
        ?>
    </div>
</div>
<?php require_once 'include/footer.php'; ?>