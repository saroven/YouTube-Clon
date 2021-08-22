<?php
require 'include/config.php';
function getValue($name){
    if (isset($_POST[$name])){
        echo $_POST[$name];
    }
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
            <h3>Sign In</h3>
            <span>to continue to VideoPipe</span>
        </div>
        <div class="signInForm">
            <form action="signin.php" method="post">
                <input type="text" name="username" placeholder="Username" value="<?php getValue('username'); ?>" autocomplete="off" required>
                <input type="password" name="pass" placeholder="Password" autocomplete="off" required>
                <input type="submit" name="submit" value="SUBMIT">
            </form>
        </div>
        <a class="signInMessage" href="signup.php">Don't have an account ? Sign Up here!</a>
    </div>
</div>
</body>
</html>