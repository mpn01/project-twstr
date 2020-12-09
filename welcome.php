<?php
    session_start();

    //sprawdzanie czy użytkownik jest zalogowany, jeśli jest, przenosi go do profile.php
     if(!isset($_SESSION['register_complete'])) {
        header('Location: index.php');
        exit();
    } else {
        unset($_SESSION['register_complete']);
    }
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
            <h1>You did it!</h1>
            <h2>Now you can log in to your account</h2>
            <!-- <div style="postion: absolute; width: 100%; height: 7%; background: yellow; z-index: 1;"></div> -->
            <img src="img/illustrations/high_five.svg"/>
            <a class="button" href="index.php">Log in</a>
        </div>
    </body>
</html>
