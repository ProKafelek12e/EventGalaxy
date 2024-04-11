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
    <div id="header">
        <img src="./icons/logo.svg" >
        <?php include 'list.php' ?>
    </div>
    <div id="home">

        <div id="events">

    <?php
            $conn = mysqli_connect('localhost','root','','szps');

            $currentYear = date("Y");
            $currentMonth = date("n");

            if(!$conn){
                die(mysqli_connect_error($conn));
            }
            else{
                if($_SESSION['Permission']=='wrk'){

                    echo '<div class="eventA child">';
                    echo '<form id="out" action="" method="post" id="LogForm">';
                    echo '<input type="submit" name = "Add" value="Add new event" id="add">';
                    echo '</form>';
                    echo '</div>';
                }
                $sql = "SELECT events.* FROM `events` WHERE events.date LIKE '$currentYear%$currentMonth-__' ORDER BY date asc, time asc";
                $result = mysqli_query($conn,$sql);
                if(mysqli_num_rows($result)>0){
                    while( $row = mysqli_fetch_assoc($result)){
                        echo '<div class="eventW child">';
                        echo '<span>';
                        echo '<h2>'.$row['name'].'</h2>';
                        echo '<h2>'.$row['date'].'</h2>';
                        echo '</span>';
                        echo '<form id="out" action="" method="post" id="LogForm">';
                        echo '<input type="hidden" name="event_id" value="' . $row['event_id'] . '">';
                        echo '<input type="hidden" name="Ename" value="'.$row['name'].'">';
                        echo '<input type="submit" name = "Join" value="Join" class="button f">';
                        echo '<input type="submit" name ="Info" value="Info" class="button b">';
                        echo '</form>';
                        echo '</div>';
                    }
                }
            }
        ?>
        </div>
        <?php
            include 'custom.php';
            if(isset($_POST['Join'])){
                if(isset($_POST['event_id'])){
                    $event_id = $_POST['event_id'];
                    $name = $_POST['Ename'];
                    //echo "<h1>J:".$event_id."</h1>";\
                    echo "</div>";
                    alert("Joined: $name");
                    $conn = mysqli_connect('localhost','root','','szps');

                    if(!$conn){
                        die(mysqli_connect_error($conn));
                    }
                    else{
                        $sql_check = "SELECT id FROM `user-event` WHERE `user_id` = ". $_SESSION['Id']." AND event_id=".$event_id;
                        $check = mysqli_query($conn,$sql_check);
                        if(mysqli_num_rows($check)>0){

                        }
                        else{
                            $sql = "INSERT INTO `user-event`(`user_id`, `event_id`) VALUES ('".$_SESSION['Id']."','".$event_id."')";
                            mysqli_query($conn,$sql);
                        }
                    }
                }
            }
        ?>
        <?php
            if(isset($_POST['Info'])){
                if(isset($_POST['event_id'])){
                    $event_id = $_POST['event_id'];

                    echo '<div id="featured" class="child">';
                    //echo "<h1>I:".$event_id."</h1>";
                    $conn = mysqli_connect('localhost','root','','szps');

                    $currentYear = date("Y");
                    $currentMonth = date("n");
        
                    if(!$conn){
                        die(mysqli_connect_error($conn));
                    }
                    else{
                        $sql = "SELECT events.* FROM `events` WHERE events.event_id =$event_id";
                        $result = mysqli_query($conn,$sql);
                        $row = mysqli_fetch_assoc(($result));
                        echo "<span>";
                        echo "<h1>".$row['name']."</h1>";
                        echo "<h2>".$row['date']."</h2>";
                        echo "<p>".$row['description']."</p>";
                        echo "</span>";
                        echo "<form method='post' action=''>";
                        echo '<input type="hidden" name="event_id" value="' . $row['event_id'] . '">';
                        echo '<input type="hidden" name="Ename" value="'.$row['name'].'">';
                        echo '<input type="submit" name = "Join" value="Join" class="button f">';
                        echo "</form>";
                    }
                    echo '</div>';
                }
            }
        ?>
        <?php
        ?>
</body>
</html>