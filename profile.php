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
        <link rel="stylesheet" type="text/css" href="main.css"/>
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
                            <img src="img/illustrations/male_avatar.svg"/>
                            <h1>$_SESSION[name]</h1>
                            <span class="profile_person_username">@$_SESSION[login]</span>
                            </div>
                        <div id="profile_content">
                            <div id="profile_content_menu">
                                <a class="profile_content_menu_button" href=""><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-news" width="44" height="44" viewBox="0 0 24 24" stroke-width="2" stroke="#545454" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>                               <path d="M16 6h3a1 1 0 0 1 1 1v11a2 2 0 0 1 -4 0v-13a1 1 0 0 0 -1 -1h-10a1 1 0 0 0 -1 1v12a3 3 0 0 0 3 3h11" />
                                <line x1="8" y1="8" x2="12" y2="8" />
                                <line x1="8" y1="12" x2="12" y2="12" />
                                <line x1="8" y1="16" x2="12" y2="16" />
                              </svg>News feed</a>
                                <a class="profile_content_menu_button" href=""><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user" width="44" height="44" viewBox="0 0 24 24" stroke-width="2" stroke="#545454" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <circle cx="12" cy="7" r="4" />
                                <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                              </svg>Profile settings</a>
                                <a class="profile_content_menu_button" href=""><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-settings" width="44" height="44" viewBox="0 0 24 24" stroke-width="2" stroke="#545454" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" />
                                <circle cx="12" cy="12" r="3" />
                              </svg>App settings</a>
                                <a class="profile_content_menu_button" href=""><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-3d-cube-sphere" width="44" height="44" viewBox="0 0 24 24" stroke-width="2" stroke="#545454" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M6 17.6l-2 -1.1v-2.5" />
                                <path d="M4 10v-2.5l2 -1.1" />
                                <path d="M10 4.1l2 -1.1l2 1.1" />
                                <path d="M18 6.4l2 1.1v2.5" />
                                <path d="M20 14v2.5l-2 1.12" />
                                <path d="M14 19.9l-2 1.1l-2 -1.1" />
                                <line x1="12" y1="12" x2="14" y2="10.9" />
                                <line x1="18" y1="8.6" x2="20" y2="7.5" />
                                <line x1="12" y1="12" x2="12" y2="14.5" />
                                <line x1="12" y1="18.5" x2="12" y2="21" />
                                <path d="M12 12l-2-1.12" />
                                <line x1="6" y1="8.6" x2="4" y2="7.5" />
                              </svg>Other projects</a>
                                </div>
                            <a class='button' href='logout.php'>Logout</a>
                            </div>
END
                    ?>
        </main>
    </body>
</html>