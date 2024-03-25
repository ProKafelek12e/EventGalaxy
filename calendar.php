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
    <div id="calendar">

        <?php
        if(isset($_SESSION['Id'])&&$_SESSION['Id']!=null){
            
            function formatTime($time){
                return '<span class="timeContainer"><span>'.substr($time,0,2).'</span>'.'<span class="top">'.substr($time,3,2).'</span></span>';
            }

            // Get the current year and month
            $currentYear = date("Y");
            $currentMonth = date("n");
            $events = [];
            $event_count = 0;
            $conn = mysqli_connect('localhost','root','','szps');
            
            if(!$conn){
                die(mysqli_connect_error($conn));
            }
            else{
                $sql = "SELECT events.* FROM `user-event`,`events` WHERE `user-event`.`event_id` = events.event_id and `user-event`.`user_id`= ".$_SESSION['Id']." AND  events.date LIKE '$currentYear%$currentMonth-__' ORDER BY date asc, time asc";
                $result = mysqli_query($conn,$sql);
                if(mysqli_num_rows($result)>0){
                    while( $row = mysqli_fetch_assoc($result)){
                        $events[] = ['id' => $row['event_id'], 'name' => $row['name'], 'description' => $row['description'], 'date' => $row['date'], 'time' => $row['time']];
                    }
                }
            }

            // Get the number of days in the current month
            $numDaysInMonth = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);

            // Get the first day of the month
            $firstDayOfMonth = date("N", mktime(0, 0, 0, $currentMonth, 1, $currentYear));

            // Output the calendar
            echo "<table>";
            echo "<tr>";

            // Fill in blank cells for days before the first day of the month
            for ($i = 1; $i < $firstDayOfMonth; $i++) {
                echo "<td></td>";
            }

            // Fill in the days of the month
            for ($day = 1; $day <= $numDaysInMonth; $day++) {
                if($firstDayOfMonth==7){
                    if($day==date('d')){
                        echo "<td><h4 class='sunday today'>$day</h4>";
                    }
                    else{
                        echo "<td><h4 class='sunday'>$day</h4>";
                    }
                    if($event_count<count($events)){
                        if(substr($events[$event_count]['date'],-2)==$day){
                            echo '<div class="event">';
                            echo '<span>';
                            echo '<h5>'.$events[$event_count]['name'].'</h5>';
                            echo '<h5>'.formatTime($events[$event_count]['time']).'</h5>';
                            echo '</span>';
                            echo '<hr color="#f2c70d">';
                            echo '</div>';

                            $event_count+=1;
                        }
                    }
                    echo "</td>";
                }
                else{
                    if($day==date('d')){
                        echo "<td><h4 class='today'>$day</h4>";
                    }
                    else{
                        echo "<td><h4>$day</h4>";
                    }
                    if($event_count<count($events)){
                        if(substr($events[$event_count]['date'],-2)==$day){

                            echo '<div class="event">';
                            echo '<span>';
                            echo '<h5>'.$events[$event_count]['name'].'</h5>';
                            echo '<h5>'.formatTime($events[$event_count]['time']).'</h5>';
                            echo '</span>';
                            echo '<hr color="#f2c70d">';
                            echo '</div>';
                        
                            $event_count+=1;

                        }
                    } 
                    echo "</td>";
                }
                $firstDayOfMonth++;
                if ($firstDayOfMonth > 7) {
                    echo "</tr><tr>";
                    $firstDayOfMonth = 1;
                }
            }

            // Fill in blank cells for remaining days of the week
            while ($firstDayOfMonth > 1 && $firstDayOfMonth <= 7) {
                echo "<td></td>";
                $firstDayOfMonth++;
            }

            echo "</tr>";
            echo "</table>";
            
        }
        else{
            echo "<h4 class='comm'>You must login to access calendar</h4>";
            echo "<a href='./account.php'><button class='redirect'>Log in</button></a>";
        }
        ?>


    </div>

</body>
</html>