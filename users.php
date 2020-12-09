<?php
    session_start();
    require_once "connect.php";
    ?>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/main.css"/>
    <title>All users</title>
</head>
<body style="display: flex; align-items: center; justify-content: center; flex-direction: column">
    <?php
        try{
            $conn = new mysqli($servername, $db_username, $password, $dbname);
            if($conn->connect_errno != 0){
                throw new Exception(mysqli_connect_errno());
            } else {
                $query = "SELECT * FROM users";
                $result = $conn->query($query);
                echo "<table>";
                echo "<thead>";
                    echo "<td>id</td>";
                    echo "<td>Name</td>";
                    echo "<td>Username</td>";
                    echo "<td>E-mail</td>";
                echo "</thead>";
                while(($row = $result->fetch_assoc()) != 0){
                    echo "<tr>";
                        echo "<td>".$row['id']."</td>";
                        echo "<td>".$row['name']."</td>";
                        echo "<td>".$row['login']."</td>";
                        echo "<td>".$row['email']."</td>";
                    echo "</tr>";

                }
                echo "</table>";
                echo "<a class='button' onclick='goBack()''>Go back</a>";
            }
        } catch (Exception $e) {
            echo "Server error. Sorry for problems. Please comeback later.";
            echo '<br/>Developer info: '.$e; // wyłączyć przy wrzucaniu na prawdziwy serwer
        }
    ?>
    <script src="js/main.js"></script>
</body>
</html>