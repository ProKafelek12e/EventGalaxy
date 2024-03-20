<?php
session_start()
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Manager</title>
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
    <div  id="form">
        <form action="" method="post">
            <span>
                <input type="text" class="input_style" placeholder="Login">
                <input type="password" class="input_style" placeholder="Password"> 
            </span>
            <span>
                <input type="button" value="Sign Up" class="button"> 
                <input type="submit" value="Sign In" class="button">
            </span>
        </form>
    </div>
</body>
</html>