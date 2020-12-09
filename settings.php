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
    <link rel="stylesheet" type="text/css" href="css/main.css"/>
    <link rel="stylesheet" type="text/css" href="css/settings.css"/>
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

                $userName = $_SESSION['name'];
                $userLogin = $_SESSION['login'];
                $userEmail = $_SESSION['email'];


                echo "<form method='post'>";
                    echo "<img src='img/illustrations/male_avatar.svg'/>";
                    echo "<button class='button'>Change profile picture</button>";
                    echo "<label for='name' id='label1'>Name</label>";
                    echo "<input type='text' name='name' value='".$userName."'/><br/>";
                    echo "<label for='login' id='label2'>Login</label>";
                    echo "<input type='text' name='login' value='".$userLogin."'/><br/>";
                    echo "<label for='email' id='label3'>E-mail</label>";
                    echo "<input type='email' name='email' value='".$userEmail."'/><br/>";
                    echo "<button style='margin-top: 5vh;'class='button' type='submit' >Save profile</button>";
                    echo "<a style='margin-top: 2vh;' onclick='goBack()'>Go back</a>";
                echo "</form>";

            }

        } catch (Exception $e) {
            echo "Server error. Sorry for problems. Please comeback later.";
            echo '<br/>Developer info: '.$e; // wyłączyć przy wrzucaniu na prawdziwy serwer
        }
    ?>
    <script src="js/settings.js"></script>
    <script src="js/main.js"></script>
    </div>
</body>
</html>