<?php
require_once 'include/header.php';
require_once 'include/classes/Account.php';
require_once 'include/classes/FormValidation.php';
require_once 'include/classes/Constants.php';
require_once 'include/classes/SettingsFormProvider.php';
if (!User::isLoggedIn()){
    header("location: signIn.php");
}
$detailsMessage = "";
$passwordMessage = "";

$settingsFormProvider = new SettingsFormProvider();

if (isset($_POST['saveDetailsButton'])){
    $account = new Account($conn);
    $firstName = FormValidation::sanitizeFormString($_POST['fname']);
    $lastName = FormValidation::sanitizeFormString($_POST['lname']);
    $email = FormValidation::sanitizeFormEmail($_POST['email']);

    if($account->updateDetails($firstName, $lastName,$email,$userLoggedInObj->getUserName())){
        //success
        $detailsMessage = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                              <strong>SUCCESS!</strong> Details updated successfully!
                              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                              </button>
                            </div>";

    }else{
        //update failed
        $errorMessage = $account->getFirstError();

        if(empty($errorMessage)) $errorMessage = "Something Went Wrong";

        $detailsMessage = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                              <strong>ERROR!</strong> $errorMessage
                              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                              </button>
                            </div>";
    }
}
?>

<div class="settingsContainer column">
    <div class="formSection">
        <div class="message">
            <?php echo $detailsMessage;?>
        </div>
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