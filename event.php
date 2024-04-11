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
    if($_SESSION['Permission']!='wrk') header('Location:index.php')
    ?>
    <div id="header">
        <img src="./icons/logo.svg" >
        <?php include 'list.php' ?>
    </div>
    <div id="content">

    <div id="AddForm">
        <form action="" method="post">
            <label for="name">Name of the Event</label>
            <input type="text" name="name" maxlength="50" id="name"><br> 
            <label for="description">Description of the Event</label>
            <textarea name="description" rows="4" cols="50" id="description"></textarea><br> 
            <label for="date">Date of the Event</label>
            <input type="date" name="date" id="date"><br> 
            <label for="time">Time of the Event</label>
            <input type="time" name="time" id="time"><br> 
            <input type="submit" value="Add event" class="button f" id="submit">
        </form>
    </div>
    <?php
        $conn = mysqli_connect('localhost','root','','szps');

        if(!$conn){
            die(mysqli_connect_error($conn));
        }
        else{
            if(isset($_POST['name'],$_POST['description'],$_POST['date'],$_POST['time'])){        
                $name = $_POST['name'];$descrption = $_POST['description'];$date = $_POST['date'];$time = $_POST['time'];
                $sql = "INSERT INTO `events`(`name`, `description`, `date`, `time`) VALUES ('$name','$descrption','$date','$time')";
                mysqli_query($conn,$sql);
            }
        }
    ?>
</body>
</html>