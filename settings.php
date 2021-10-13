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

if (isset($_POST['saveDetailsButton'])){
    $account = new Account($conn);
    $firstName = FormValidation::sanitizeFormString($_POST['fname']);
    $lastName = FormValidation::sanitizeFormString($_POST['lname']);
    $email = FormValidation::sanitizeFormString($_POST['email']);
}
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