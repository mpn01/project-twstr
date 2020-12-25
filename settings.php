<?php
    session_start();

        //sprawdzanie czy użytkownik jest zalogowany do profilu, jeśli nie, przenosi go do index.php
        if(!isset($_SESSION['logged'])){
            header('Location: index.php');
            exit();
        }
?>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles/css/main.css"/>
    <link rel="stylesheet" type="text/css" href="styles/css/settings.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600;700&display=swap" rel="stylesheet">
    <title>Settings</title>
</head>
<body>
    <div id="settings-main">
    <?php
        require_once 'connect.php';
        $userId = $_SESSION['id'];

        try {

            $conn = new mysqli($servername, $db_username, $password, $dbname);
            if($conn->connect_errno != 0){
                throw new Exception(mysqli_connect_errno());
            } else {

                $querySelect = "SELECT email FROM users";
                $resultSelect = $conn->query($querySelect);
                $rowSelect = $resultSelect->fetch_assoc();
                //przypisanie zmiennych sesyjnych do zmiennych lokalnych
                $userName = $_SESSION['name'];
                $userLogin = $_SESSION['login'];
                $userEmail = $_SESSION['email'];
                $userPass = $_SESSION['pass'];


                //jeżeli zmienna się utworzy, zostaną wykonane instrukcje niżej
                if(isset($_POST['submit'])){

                    $settingsComplete = true;
                    $userNameChanged = $_POST['nameChanged'];
                    //$userLoginChanged = $_POST['loginChanged'];


                    //walidaca adresu email
                    $userEmailChanged = $_POST['emailChanged'];
                    //przefiltrowywanie adresu email
                    $email_filtered = filter_var($userEmailChanged, FILTER_SANITIZE_EMAIL);
                    //sprawdzanie czy przefiltrowany email i wpisany email są takie same
                    if(!filter_var($email_filtered, FILTER_VALIDATE_EMAIL) || ($email_filtered!=$userEmailChanged)){
                        $_SESSION['settings_email_error'] = "<div class='main_error'>Invaild e-mail address</div>";
                        $settingsComplete = false;
                    }

                    //wyciąganie z bazy informacji, czy taki adres email jest już wpisany
                    $result_email = $conn->query("SELECT id FROM users WHERE email='$userEmailChanged'");
                    if(!$result_email) throw new Exception($conn->error);
                    $email_check = $result_email->num_rows;
                    //sprawdzanie czy konto z podanym adresem email już istnieje
                    if($email_check>0){
                        if($userEmailChanged != $userEmail){
                            $_SESSION['settings_email_error'] = "<div class='main_error'>Account with this e-mail already exist</div>";
                            $settingsComplete = false;
                        }
                    }

                    //walidacja imienia
                    $userNameChanged = htmlentities($userNameChanged, ENT_QUOTES, "UTF-8");
                    if(!ctype_alpha($userNameChanged)){
                        $_SESSION['settings_name_error'] = "<div class='main_error'>Your name should contain only letters</div>";
                        $settingsComplete = false;
                    }

                    //jeżeli pola formularza są takie same jak informacje w bazie danych
                    if($userName === $userNameChanged && $userEmail === $userEmailChanged){
                        $_SESSION['settings_error'] = '<div class="main_error">You need to change something!</div>';
                        $settingsComplete = false;
                    }

                    //aktualizowanie profulu według wprowadzonych danych
                    $queryUpdateProfile = "UPDATE users SET name='$userNameChanged', email='$userEmailChanged' WHERE id='$userId'";
                    if($settingsComplete == true){
                        if($conn->query($queryUpdateProfile)){
                            header("Location: profile.php"); //przenosi do strony profilu
                            $_SESSION['name'] = $userNameChanged;  //zmienia zmienną sesyjną na wartosći wpisane w formularzu
                            $_SESSIONN['email'] = $userEmail; // jak wyżej
                            $_SESSION['settings_success'] = '<div class="main_success">Your account has been updated</div>'; //tworzy zmienną sesyjną z powiadomieniem o pomyślnej zmianie danych
                        } else {
                            throw new Exception(mysqli_connect_error());
                        }
                    }
                }
            }
        } catch (Exception $e) {
            echo "Server error. Sorry for problems. Please comeback later.";
            echo '<br/>Developer info: '.$e; // wyłączyć przy wrzucaniu na prawdziwy serwer
        }
    ?>
    <?php
        echo "<div id='settings-main-right'>";
        echo "<h2>Change your profile details</h2>";
            echo "<form method='post'>";
                echo "<label for='email' id='label3'>Login</label>";
                echo "<input type='text' name='loginChanged' value='".$userLogin."' disabled/><br/>";;
                echo "<label for='name' id='label1'>Name</label>";
                echo "<input type='text' name='nameChanged' value='".$userName."' required/><br/>";
                echo "<label for='login' id='label2'>E-mail</label>";
                echo "<input type='email' name='emailChanged' value='".$userEmail."' required/><br/>";
                echo "<p style='color: var(--gray);'>Want to change your password? <a href='changepassword.php'>Click here</a></p>";
                echo "<button style='margin-top: 5vh;'class='button' type='submit' name='submit'><img src='img/icons/disc-floppy.svg'>&nbspSave profile</button>";
            echo "</form>";
        echo "</div>";

        if(isset($_SESSION['settings_error'])){
            echo $_SESSION['settings_error'];
            unset($_SESSION['settings_error']);
        };
        if(isset($_SESSION['settings_email_error'])){
            echo $_SESSION['settings_email_error'];
            unset($_SESSION['settings_email_error']);
        };
        if(isset($_SESSION['settings_name_error'])){
            echo $_SESSION['settings_name_error'];
            unset($_SESSION['settings_name_error']);
        };
    ?>
    <footer>
        <a class="button" style="margin-bottom: 3vh;" href='profile.php'><img src='img/icons/arrow-back-up.svg'>&nbspGo back</a>
    </footer>
    <script src="js/settings.js"></script>
    <script src="js/main.js"></script>
    </div>
</body>
</html>