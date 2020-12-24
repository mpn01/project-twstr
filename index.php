<?php
    session_start();

    //sprawdzanie czy użytkownik jest zalogowany, jeśli jest, przenosi go do profile.php
    if(isset($_SESSION['logged']) && ($_SESSION['logged'] == true)) {
        header('Location: profile.php');
        exit();
    }
?>
<html>
    <head>
        <title>Log in</title>
        <meta charset="UTF-8"/>
        <link rel="stylesheet" type="text/css" href="styles/css/main.css"/>
        <link rel="stylesheet" type="text/css" href="styles/css/index.css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600;700&display=swap"
            rel="stylesheet">
    </head>
    <body>
        <div id="index_main">
            <img class="index_photo" src="img/illustrations/login.svg"/>
            <h3><center>Log in to access your profile</center></h3>
            <form id="index_form" action="login.php" method="post">
                <!-- <label for="login"><center><img width="60%" src="img/person.svg"/></center></label> -->
                <input type="text" name="login" placeholder=" username" required/>
                <!-- <label for="pass"><center><img width="60%" src="img/key.svg"/></center></label> -->
                <input type="password" name="pass" placeholder=" password" required/>
                <button class="button" type="submit"><img src="img/icons/login.svg">&nbspLog in</button>
            </form>
            <p id="index_register_link">If you don't have an account, <a href="register.php">register here</a></p>
            <?php
            if(isset($_SESSION['error'])) echo $_SESSION['error'];
            ?>
        </div>
        <script type="text/javascript">
    </script>
    </body>
</html>
