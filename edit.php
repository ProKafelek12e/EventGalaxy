<?php
session_start()
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Galaxy</title>
    <link rel="icon" href="./icons/logo.svg">
    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <!-- Style -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    if($_SESSION['Permission']=='wrk' || $_SESSION['Permission']=='adm'){}
    else header('Location:index.php')
    ?>
    <div id="header">
        <img src="./icons/logo.svg" >
        <?php include 'list.php' ?>
    </div>
    <div id="content">

    <div id="AddForm">
        <?php
        $conn = mysqli_connect('localhost','root','','szps');

        if(!$conn){
            die(mysqli_connect_error($conn));
        }
        else{
            $sql = "SELECT * FROM `events` WHERE event_id=".$_SESSION['Edited'];
            $result = mysqli_query($conn,$sql);
            $row = mysqli_fetch_assoc($result);
            echo '<form action="" method="post">';
            echo '<label for="name">Name of the Event</label>';
            echo '<input type="text" name="name" maxlength="50" id="name" value="'.$row['name'].'"><br>';
            echo '<label for="description">Description of the Event</label>';
            echo '<textarea name="description" rows="4" cols="50" id="description">'.$row['description'].'</textarea><br>';
            echo '<label for="date">Date of the Event</label>';
            echo '<input type="date" name="date" id="date" value="'.$row['date'].'"><br>';
            echo '<label for="time">Time of the Event</label>';
            echo '<input type="time" name="time" id="time" value="'.$row['time'].'"><br>';
            echo '<input type="submit" name="Edit" value="Save" class="button f" id="submit">';
            echo '</form>';
        }
        ?>
    </div>
    <?php
        $conn = mysqli_connect('localhost','root','','szps');

        if(!$conn){
            die(mysqli_connect_error($conn));
        }
        else{
            if(isset($_POST['name'],$_POST['description'],$_POST['date'],$_POST['time'])){        
                $name = $_POST['name'];$descrption = $_POST['description'];$date = $_POST['date'];$time = $_POST['time'];
                $sql = "UPDATE `events` SET `name`='$name',`description`='$descrption',`date`='$date',`time`='$time' WHERE event_id=".$_SESSION['Edited'];
                $result = mysqli_query($conn,$sql);
                header('Location:index.php');
            }
        }
    ?>
</body>
</html>