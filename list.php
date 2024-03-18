<ul>
    <li><a href="./index.php">Home</a></li>
    <li><a href="./calendar.php">Calendar</a></li>
    <li><a href="./login.php">Login</a></li>
    <li><a href="./register.php">Register</a></li>
    <?php if($_SESSION['Permission']=='adm'||$_SESSION['Permission']=='wrk') echo '<li><a href="./events.php">Manage Events</a></li>' ?>
    <?php if($_SESSION['Permission']=='adm') echo '<li><a href="./permission.php">Permissions</a></li>' ?>
    <?php if($_SESSION['IsLoged']==true) echo '<li><a href="./logout.php">Log out</a></li>' ?>
</ul>