<?php

session_start();
require_once "connect.php";
$userId = $_SESSION['id'];
$currentPass = $_SESSION['pass'];

if(isset($_POST['submit'])) {

    $formComplete = true;

        //walidacja starego hasła
        $oldPassword = $_POST['oldPassword'];
            //sprawdzanie czy wpisane obecne hasło zgadza się z tym z bazy danych
            if(password_verify($oldPassword, $currentPass) == false){
                $formComplete = false;
                $_SESSION['old_pass_error'] = "<div class='main_error'>You typed a wrong password</div>";
            }

        //walidacja nowego hasła
        $newPass1 = $_POST['newPassword'];
        $newPass2 = $_POST['newPasswordRepeat'];
            //sprawdzanie czy hasło ma przynajmniej 8 znaków
            if($newPass1>8) {
                $formComplete = false;
                $_SESSION['new_pass_error'] = "<div class='main_error'>Password should consist minimum 8 characters</div>";
            }
            //sprawdzanie czy wpisane hasła są takie same
            if($newPass1!=$newPass2) {
                $formComplete = false;
                $_SESSION['new_pass_error'] = "<div class='main_error'>Passwords don't match</div>";
            }
            //hashowanie nowego hasła
            $passChanged = password_hash($newPass1, PASSWORD_DEFAULT);

        try {
            $conn = new mysqli($servername, $db_username, $password, $dbname);
            if($conn->connect_errno != 0){
                throw new Exception(mysqli_connect_error());
            } else {
                if($formComplete == true){
                    $queryChangePassword = "UPDATE users SET pass='$passChanged' WHERE id='$userId'";
                    if($conn->query($queryChangePassword)){
                        header("Location: profile.php");
                        $_SESSION['pass_changed_success'] = '<div class="main_success">Your password has been changed</div>'; //tworzy zmienną sesyjną z powiadomieniem o pomyślnej zmianie danych
                    } else {
                        throw new Exception($conn->error);
                    }

                }

            }
        } catch (Exception $e) {
            echo "Database connect error";
        }

        $conn->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/css/main.css"/>
    <link rel="stylesheet" href="styles/css/settings.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600;700&display=swap" rel="stylesheet">
    <title>Change your password</title>
</head>
<body>
    <div id="pass-main">
    <form method="post">
    <h2>Change your password</h2>
        <label for="oldPassword">Type your current password</label>
        <input type="password" name="oldPassword"/>
        <label for="newPassword">Type your new password</label>
        <input type="password" name="newPassword"/>
        <label for="newPasswordRepeat">Repeat your new password</label>
        <input type="password" name="newPasswordRepeat"/>
        <button class="button" name="submit" type="submit"><img src="img/icons/lock-white.svg"/>Change your password</button>
    </form>
    </div>
    <footer>
        <a class="button" style="margin-bottom: 3vh;" href='settings.php'><img src='img/icons/arrow-back-up.svg'>&nbspGo back</a>
    </footer>
    <?php
    if(isset($_SESSION['old_pass_error'])) {
        echo $_SESSION['old_pass_error'];
        unset($_SESSION['old_pass_error']);
    }
    if(isset($_SESSION['new_pass_error'])) {
        echo $_SESSION['new_pass_error'];
        unset($_SESSION['new_pass_error']);
    }
    ?>
</body>
</html>