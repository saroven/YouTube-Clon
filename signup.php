<?php
require 'include/config.php';
require 'include/classes/Constants.php';
require 'include/classes/FormValidation.php';
require 'include/classes/Account.php';

$account = new Account($conn);

$validate = new FormValidation();
if (isset($_POST['submit'])){
    $fname = FormValidation::sanitizeFormString($_POST['fname']);
    $lname = FormValidation::sanitizeFormString($_POST['lname']);
    $username = FormValidation::sanitizeFormUsername($_POST['username']);
    $email = FormValidation::sanitizeFormEmail($_POST['email']);
    $pass = FormValidation::sanitizeFormPassword($_POST['pass']);
    $cpass = FormValidation::sanitizeFormPassword($_POST['cpass']);

    $account->register($fname, $lname, $username, $email, $pass, $cpass);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>You Pipe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
    <script src="./assets/js/commonAction.js"></script>
</head>
<body>
<div class="signInContainer">
    <div class="column">
        <div class="header">
            <img src="./assets/images/icons/youpipe.png" alt="Site logo" title="logo">
            <h3>Sign Up</h3>
            <span>to continue to VideoPipe</span>
        </div>
        <div class="logInForm">
            <form action="signup.php" method="post">

                <?php echo $account->getError(Constants::$firstNameCharacters)?>
                <input type="text" name="fname" placeholder="First Name" autocomplete="off" required>

                <?php echo $account->getError(Constants::$lastNameCharacters)?>
                <input type="text" name="lname" placeholder="Last Name" autocomplete="off" required>

                <?php echo $account->getError(Constants::$usernameTaken)?>
                <?php echo $account->getError(Constants::$usernameCharacters)?>
                <input type="text" name="username" placeholder="Username" autocomplete="off" required>

                <?php echo $account->getError(Constants::$invalidEmail)?>
                <?php echo $account->getError(Constants::$emailTaken)?>
                <input type="email" name="email" placeholder="Email" autocomplete="off" required>

                <input type="password" name="pass" placeholder="Password" autocomplete="off" required>
                <?php echo $account->getError(Constants::$passwordNotMatch)?>
                <?php echo $account->getError(Constants::$passwordCharacter)?>
                <input type="password" name="cpass" placeholder="Confirm Password" autocomplete="off" required>
                <input type="submit" name="submit" value="SUBMIT">
            </form>
        </div>
        <a class="signInMessage" href="signin.php">Already have an account ? Sign in here!</a>
    </div>
</div>
</body>
</html>