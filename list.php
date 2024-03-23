<ul id="tabs">
    <li class="tab active"><a href="./"><img src="./icons/home.svg"><h3>Home</h3></a></li>
    <li class="tab active"><a href="./calendar.php"><img src="./icons/calendar.svg"><h3>Calendar</h3></a></li>
    <li class="tab active"><a href="./account.php"><img src="./icons/logIn.svg"><h3>Log in</h3></a></li>
    <?php
    if(isset($_SESSION['upr'])){    
        if($_SESSION['upr']=='adm'){
            echo '<li class="tab active"><a href="./permission.php"><img src="./icons/server.svg"><h3>Permission</h3></a></li>';
        }
    }
    ?>
</ul>