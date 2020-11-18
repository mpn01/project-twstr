<?php
    session_start();

    //sprawdzanie czy użytkownik jest zalogowany, jeśli jest, przenosi go do profile.php
    /* if(!isset($_SESSION['register_complete'])) {
        header('Location: index.php');
        exit();
    } else {
        unset($_SESSION['register_complete']);
    }*/
?>
<html>
    <head>
        <title>Welcome!</title>
        <meta charset="UTF-8"/>
        <link rel="stylesheet" type="text/css" href="css/main.css"/>
        <link rel="stylesheet" type="text/css" href="css/welcome.css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600;700&display=swap"
            rel="stylesheet">
    </head>
    <body>
        <div id="welcome_main">
            <div style="postion: relative; width: 50%; height: 5%; background: white;"></div>
            <h1>You did it!</h1>
            <img class="index_photo" src="img/illustrations/high_five.svg"/>
            <a class="button" href="index.php">Log in</a>
        </div>
    </body>
</html>
