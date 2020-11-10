<?php

    session_start();

    if(!isset($_POST['login']) || !isset($_POST['pass'])){
        header('Location: index.php');
        exit();
    }

    require_once "connect.php";

    $conn = @new mysqli($servername, $username, $password, $dbname);

    if($conn->connect_errno!=0){
        echo "Error: ".$conn->connect_errno;
    } else {
        $login=$_POST['login'];
        $pass=$_POST['pass'];

        $login = htmlentities($login, ENT_QUOTES, "UTF-8");
        $pass = htmlentities($pass, ENT_QUOTES, "UTF-8");

        if($loginResult = @$conn->query(sprintf("SELECT * FROM users WHERE login='%s' && pass='%s'",
        mysqli_real_escape_string($conn, $login),
        mysqli_real_escape_string($conn, $pass)))){
            if($loginResult->num_rows > 0){

                $_SESSION['logged'] = true;

                $rows = $loginResult->fetch_assoc();
                $_SESSION['id'] = $rows['id'];
                $_SESSION['login'] = $rows['login'];
                $_SESSION['name'] = $rows['name'];
                $_SESSION['email'] = $rows['email'];
                $_SESSION['picture'] = $rows['picture'];

                unset($_SESSION['error']);
                $loginResult->close();

                header('Location: profile.php');
            } else {
                $_SESSION['error'] = '<div id="index_login_error">Wrong username or password</div>';
                header('Location: index.php');
            }
        };

        $conn->close();
    }
?>