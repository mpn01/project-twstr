<?php

    session_start();

    //jeżeli zmienne 'login' i 'pass' nie istnieją, przenosi odwiedzającego do index.php
    if(!isset($_POST['login']) || !isset($_POST['pass'])){
        header('Location: index.php');
        exit();
    }
    //wymaga pliku connect.php(w którym zawarte są dane logowania do bazy danych)
    require_once "connect.php";

    $conn = @new mysqli($servername, $db_username, $password, $dbname);

    if($conn->connect_errno!=0){
        echo "Error: ".$conn->connect_errno;
    } else {
        $login=$_POST['login'];
        $pass=$_POST['pass'];

        //login jest przetwarzany przez funkcje htmlentities która zapobiega tzw. "wstrzykiwaniu SQL"(zamienia znaczniki znaki specjalne na odpowiadające mu encje)
        $login = htmlentities($login, ENT_QUOTES, "UTF-8");

        //przetwarzanie loginu  przez funkcję mysqli_real_escape_string, która zabezpiecza kod przed wstrzykiwaniem SQL. funkcja sprintf tworzy łańcuchy znaków powiązane z %s
        if($loginResult = @$conn->query(sprintf("SELECT * FROM users WHERE login='%s'",
        mysqli_real_escape_string($conn, $login)))){
            if($loginResult->num_rows > 0){
                $rows = $loginResult->fetch_assoc();
                //sprawdzanie czy hasło jest zgodne z hasłem w bazie danych(hashowane)
                if(password_verify($pass, $rows['pass'])){

                    //jeśli dane do logwania są dobre, użytkownik otrzymuje status zalogowanego
                    $_SESSION['logged'] = true;

                    //pobieranie elementów z bazy danych, pasujących do tego użytkownika
                    $_SESSION['id'] = $rows['id'];
                    $_SESSION['login'] = $rows['login'];
                    $_SESSION['name'] = $rows['name'];
                    $_SESSION['email'] = $rows['email'];
                    $_SESSION['picture'] = $rows['picture'];

                    //usuwanie powiadomienia o złym loginie/haśle, jeżeli dane logowania pasują
                    unset($_SESSION['error']);
                    $loginResult->close();

                    header('Location: profile.php');
                } else {
                    //powiadomienie o złym haśle
                    $_SESSION['error'] = '<div id="index_login_error">Wrong password</div>';
                    header('Location: index.php');
                }
            } else {
                //powiadomienie o złym  loginie
                $_SESSION['error'] = '<div id="index_login_error">Account not found</div>';
                header('Location: index.php');
            }
        };

        $conn->close();
    }
?>