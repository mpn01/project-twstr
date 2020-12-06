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

            function dropTask(){
                $dropQuery = "DELETE FROM tasks WHERE id='".$row['id']."'";
                $conn->query($dropQuery);
            }

            $userId = $_SESSION['id'];
            $query = "SELECT * FROM tasks WHERE id_user ='".$userId."'";

            if($result = $conn->query($query)){
                while(($row = $result->fetch_assoc())!=0){
                    echo "<div id='todo_main_task'>";
                    echo "<div class='todo_main_task_title'><h2>&nbsp".$row['title']."</h2></div><br/>";
                    echo $row['date']."<br/>";
                    echo $row['time'];
                    echo "<a class='todo_main_task_button done' onclick='taskDone()'></a>";
                    echo "<a class='todo_main_task_button delete'></a>";
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
    <footer><a class="button" href="add-task.php">Add task</a></footer>
    <script src="js/main.js"></script>
    <script src="js/todo.js"></script>
</body>
</html>