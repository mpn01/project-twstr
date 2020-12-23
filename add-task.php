<?php
    session_start();
    require_once "connect.php";

        //sprawdzanie czy użytkownik jest zalogowany do profilu, jeśli nie, przenosi go do index.php
        if(!isset($_SESSION['logged'])){
            header('Location: index.php');
            exit();
        }

    $userId = $_SESSION['id'];

    if(isset($_POST['title'])){
        $taskTitle = $_POST['title'];
        $taskDate = $_POST['date'];
        $taskTime = $_POST['time'];



    try {
        $conn = new mysqli($servername, $db_username, $password, $dbname);
        if($conn->connect_errno!=0){
            throw new Exception(mysqli_connect_errno());
        } else {
            $query = "INSERT INTO tasks(title, date, time, id_user) VALUES ('$taskTitle','$taskDate','$taskTime','$userId')";
            if($conn->query($query)) {
                header('Location: todo.php');
            } else {
                throw new Exception($conn->error);
            }
        }
    } catch (Exception $e) {
        echo "Server error. Sorry for problems. Please comeback later.";
        echo '<br/>Developer info: '.$e; // wyłączyć przy wrzucaniu na prawdziwy serwer
    }
    $conn->close();
}


?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/main.css"/>
    <link rel="stylesheet" type="text/css" href="css/todo.css"/>
    <title>Add yout task</title>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600;700&display=swap"
        rel="stylesheet">
</head>
<body>
    <script src="js/main.js"></script>
    <div id="add-task_main">
        <form method="post">
            <h2>Add new task</h2>
            <input type="text" name="title" placeholder="Title"/>
            <input type="date" name="date"/>
            <input type="time" name="time" placeholder="choose a time" min="00:00" max="23:59"/>
            <button class="button" type="submit"><img src="img/icons/plus-circle.svg">&nbspAdd</button>
            <a onclick="goBack()">Go back</a>
        </form>
        <div id="add-task_img">
            <img src="img/illustrations/add_tasks.svg"/>
        </div>
    </div>
</body>
</html>