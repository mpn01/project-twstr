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
        <link rel="stylesheet" type="text/css" href="main.css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600;700&display=swap"
            rel="stylesheet">
    </head>
    <body>
        <div id="index_main">
            <img class="index_photo" src="img/illustrations/high_five.svg"/>
            <h2>You did it! Now you can log in to your account<a href="index.php">there</a></h2>
        </div>
    </body>
</html>