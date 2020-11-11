<?php
    //wylogowywanie użytkownika
    session_start();

    session_unset();
    header('Location: index.php');

?>
