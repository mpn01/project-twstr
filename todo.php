<?php
    session_start();
?>
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" type="text/css" href="css/main.css"/>
    <link rel="stylesheet" type="text/css" href="css/todo.css"/>
    <title>Todo list</title>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600;700&display=swap"
            rel="stylesheet">
</head>
<body>
    <div id="todo_main">
    <?php

    require_once('connect.php');

    try {
        $conn = new mysqli($servername, $db_username, $password, $dbname);
        if($conn->connect_errno!=0){
            throw new Exception(mysqli_connect_errno());
        }    else {
            $userId = $_SESSION['id'];
            $query = "SELECT * FROM tasks WHERE id_user ='".$userId."'";

            if($result = $conn->query($query)){
                while(($row = $result->fetch_assoc())!=0){
                    echo "<div id='todo_main_task'>";
                    echo "<div class='todo_main_task_title'><h2>".$row['title']."</h2></div><br/>";
                    echo $row['date']."<br/>";
                    echo $row['time'];
                    echo "</div>";
                }
            };
        }
    } catch(Exception $e) {
        echo "Server error. Sorry for problems. Please comeback later.";
        echo '<br/>Developer info: '.$e; // wyłączyć przy wrzucaniu na prawdziwy serwer
    }




    ?>
    </div>
</body>
</html>