<?php
    session_start();

    //sprawdzanie czy użytkownik jest zalogowany do profilu, jeśli nie, przenosi go do index.php
    if(!isset($_SESSION['logged'])){
        header('Location: index.php');
        exit();
    }
?>

<html>
    <head>
        <title>Your profile</title>
        <meta charset="UTF-8"/>
        <link rel="stylesheet" type="text/css" href="css/main.css"/>
        <link rel="stylesheet" type="text/css" href="css/profile.css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600;700&display=swap"
            rel="stylesheet">
    </head>
    <body>
        <main>
                <?php
                    echo<<<END
                    <div id="profile_background">
                    </div>
                        <div id="profile_person">
                            <img style="border: 10px solid #F8F8F8; border-radius: 50%;" src="img/illustrations/male_avatar.svg"/>
                            <h1>$_SESSION[name]</h1>
                            <span class="profile_person_username">@$_SESSION[login]</span>
                            </div>
                        <div id="profile_content">
                            <div id="profile_content_menu">
                            <a class="profile_content_menu_button"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar" width="44" height="44" viewBox="0 0 24 24" stroke-width="2" stroke="#545454" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <rect x="4" y="5" width="16" height="16" rx="2" />
                            <line x1="16" y1="3" x2="16" y2="7" />
                            <line x1="8" y1="3" x2="8" y2="7" />
                            <line x1="4" y1="11" x2="20" y2="11" />
                            <line x1="11" y1="15" x2="12" y2="15" />
                            <line x1="12" y1="15" x2="12" y2="18" />
                          </svg>Calendar</a>
                                <a class="profile_content_menu_button" href="todo.php"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-list-check" width="44" height="44" viewBox="0 0 24 24" stroke-width="2" stroke="#545454" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M3.5 5.5l1.5 1.5l2.5 -2.5" />
                                <path d="M3.5 11.5l1.5 1.5l2.5 -2.5" />
                                <path d="M3.5 17.5l1.5 1.5l2.5 -2.5" />
                                <line x1="11" y1="6" x2="20" y2="6" />
                                <line x1="11" y1="12" x2="20" y2="12" />
                                <line x1="11" y1="18" x2="20" y2="18" />
                              </svg>Todo list</a>
                                <a class="profile_content_menu_button" href=""><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-settings" width="44" height="44" viewBox="0 0 24 24" stroke-width="2" stroke="#545454" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" />
                                <circle cx="12" cy="12" r="3" />
                              </svg>Settings</a>
                                </div>
                                <a class='button' href='logout.php'>Logout</a>
                            </div>
END
                    ?>
        </main>
    </body>
</html>