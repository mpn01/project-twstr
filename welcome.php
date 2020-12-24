<?php
    session_start();

    //sprawdzanie czy użytkownik jest zalogowany, jeśli jest, przenosi go do profile.php
    //  if(!isset($_SESSION['register_complete'])) {
    //     header('Locatiodex.phpn: index.php');
    //     exit();
    // } else {
    //     unset($_SESSION['register_complete']);
    // }
?>
<html>
    <head>
        <title>Welcome!</title>
        <meta charset="UTF-8"/>
        <link rel="stylesheet" type="text/css" href="styles/css/main.css"/>
        <link rel="stylesheet" type="text/css" href="styles/css/welcome.css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600;700&display=swap"
            rel="stylesheet">
    </head>
    <body>
        <div id="welcome_main">
            <h1 id="header1">You did it!</h1>
            <h2 id="header2">Now you can log in to your account.</h2>
            <!-- <div style="postion: absolute; width: 100%; height: 7%; background: yellow; z-index: 1;"></div> -->
            <img src="img/illustrations/high_five.svg"/>
            <a class="button" href="index.php">Log in</a>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.1/gsap.min.js"></script>
        <script>
            const header1 = document.getElementyById("header1");
            const header2 = document.getElemenetById("header2");
        </script>
    </body>
</html>
