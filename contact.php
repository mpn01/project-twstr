<?php
    session_start();
    require_once "connect.php";

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
    <link rel="stylesheet" type="text/css" href="css/contact.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600;700&display=swap" rel="stylesheet">
    <title>Contact</title>
</head>
<body>
    <form method="post">
        <h2>Contact with us</h2>
        <input type="title" name="title" placeholder="Title"><br/>
        <input type="email" name="email" placeholder="E-mail"><br/>
        <textarea placeholder="Your message"></textarea><br/>
        <button class="button" type="submit">Send</button>
    </form>
    <a style="margin-top: 5vh;" onclick="goBack()">Go back</a>
    <script src="js/main.js"></script>
</body>
</html>