<?php
    session_start();
    if(!isset($_SESSION['logged'])){
        header('Location: index.php');
        exit();
    }
?>

<html>
    <head>
        <title>Log in</title>
        <meta charset="UTF-8"/>
        <link rel="stylesheet" type="text/css" href="main.css"/>
        <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600;700&display=swap"
            rel="stylesheet">
    </head>
    <body>
        <main>
            <div id="profile_card">
                <?php
                    echo<<<END
                    <div id="profile_card_header">
                        <div id="profile_card_header_img">
                            <img width="5%" src="img/illustrations/male_avatar.svg"/>
                            </div>
                        <div id="profile_card_header_name">
                            <h2>$_SESSION[name]</h2>
                            @$_SESSION[login]
                            </div>
                        </div>
                    <a class='button' href='logout.php'>Logout</a>
END
                    ?>
                </div>
        </main>
    </body>
</html>