<?php
    session_start();

    if(isset($_POST['email'])){
        $form_complete = true;
        //walidacja nazwy użytkownika
        $username = $_POST['username'];

        if(strlen($username)<3 || strlen($username)>20){
            $form_complete = false;
            $_SESSION['e_username'] = "<div id='index_login_error'>Your username should have characters between 3 and 20</div>";
        }
        if(!ctype_alnum($username)){
            $form_complete = false;
            $_SESSION['e_username'] = "<div id='index_login_error'>Your username should consist of letters and numbers</div>";
        }
        //walidacja imienia
        $name = $_POST['name'];

        if(strlen($name)<3 || strlen($name)>20){
            $form_complete = false;
            $_SESSION['e_name'] = "<div id='index_login_error'>Your name should have characters between 3 and 20</div>";
        }
        if(!ctype_alpha($name)){
            $form_complete = false;
            $_SESSION['e_name'] = "<div id='index_login_error'>Your name should consist only letters</div>";
        }

        //walidacja adresu email
        $email = $_POST['email'];
        $email_filtered = filter_var($email, FILTER_SANITIZE_EMAIL);
        if(!filter_var($email_filtered, FILTER_VALIDATE_EMAIL) || ($email_filtered!=$email)){
            $form_complete = false;
            $_SESSION['e_email'] = "<div id='index_login_error'>Invaild e-mail address</div>";
        }

        //walidajca hasła
        $pass1 = $_POST['pass1'];
        $pass2 = $_POST['pass2'];

        if(strlen($pass1)<8){
            $form_complete = false;
            $_SESSION['e_pass'] = "<div id='index_login_error'>Password should consist minimum 8 characters</div>";
        }
        if($pass1!=$pass2){
            $form_complete = false;
            $_SESSION['e_pass'] = "<div id='index_login_error'>Passwords don't match</div>";
        }

        $pass_hash = password_hash($pass1, PASSWORD_DEFAULT);


        require_once "connect.php";
        mysqli_report(MYSQLI_REPORT_STRICT);

        try {
            $conn = new mysqli($servername, $db_username, $password, $dbname);
            if($conn->connect_errno!=0){
                throw new Exception(mysqli_connect_errno());
            } else {

                //Sprawdzanie, czy użytkownik o podanym emailu istniaje
                $result_email = $conn->query("SELECT id FROM users WHERE email='$email'");
                if(!$result_email) throw new Exception($conn->error);

                $email_check = $result_email->num_rows;
                if($email_check>0){
                    $form_complete = false;
                    $_SESSION['e_email'] = "<div id='index_login_error'>Account with this e-mail exist</div>";
                }

                //Sprawdzanie, czy użytkownik o podanym emailu istniaje
                $result_username = $conn->query("SELECT id FROM users WHERE login='$username'");
                if(!$result_username) throw new Exception($conn->error);

                $username_check = $result_username->num_rows;
                if($username_check>0){
                    $form_complete = false;
                    $_SESSION['e_username'] = "<div id='index_login_error'>This username is taken</div>";
                }

                //Formularz jest prawidłowy
                $insertQuery = "INSERT INTO users (name, login, pass, email) VALUES ('$name', '$username', '$pass_hash', '$email')";
                if($form_complete == true){
                    if($conn->query($insertQuery)){
                        $_SESSION['register_complete'] = true;
                        header('Location: welcome.php');
                    } else {
                        throw new Exception($conn->error);
                    }
                }

                $conn->close();
            }
        } catch (Exception $e) {
            echo "Server error. Sorry for problems. Please comeback later.";
            echo '<br/>Developer info: '.$e; // wyłączyć przy wrzucaniu na prawdziwy serwer
        }



    }

?>
<html>
    <head>
        <title>Register</title>
        <meta charset="UTF-8"/>
        <link rel="stylesheet" type="text/css" href="main.css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600;700&display=swap"
            rel="stylesheet">
    </head>
    <body>
        <div id="index_main">
            <h3><center>Create your account</center></h3>
            <form id="index_form" method="post">
                <input type="text" name="name" placeholder=" Name" />
                <input type="text" name="username" placeholder=" username" />
                <input type="text" name="email" placeholder=" email" />
                <input type="password" name="pass1" placeholder=" password" />
                <input type="password" name="pass2" placeholder=" again password" />
                <button class="button" type="submit" >Register</button>
            </form>
            <?php
            if(isset($_SESSION['e_username'])) {
                echo $_SESSION['e_username'];
                unset($_SESSION['e_username']);
            }
            if(isset($_SESSION['e_name'])) {
                echo $_SESSION['e_name'];
                unset($_SESSION['e_name']);
            }
            if(isset($_SESSION['e_email'])) {
                echo $_SESSION['e_email'];
                unset($_SESSION['e_email']);
            }
            if(isset($_SESSION['e_pass'])) {
                echo $_SESSION['e_pass'];
                unset($_SESSION['e_pass']);
            }
            ?>
        </div>
    </body>
</html>
