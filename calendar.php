<?php
        session_start();
        //sprawdzanie czy użytkownik jest zalogowany do profilu, jeśli nie, przenosi go do index.php
        if(!isset($_SESSION['logged'])){
            header('Location: index.php');
            exit();
        }
?>
<html lang="pl"/>
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" type="text/css" href="styles/css/main.css"/>
    <link rel="stylesheet" type="text/css" href="styles/css/calendar.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600;700&display=swap"
            rel="stylesheet">
    <title>Calendar</title>
</head>
<body>
    <div id="calendar-main">
        <img width="15%"src="img/illustrations/coffee_break.svg"/>
        <h1>Calendar is in build.<br/>Thank you for your patience.</h1>
        <a class="button"onclick="goBack()">Go back</a>
    </div>
<script src="js/date.js"></script>
<script src="js/main.js"></script>
</body>
</html>