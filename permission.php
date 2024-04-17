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
    <div id="users">
        <?php
        $conn = mysqli_connect('localhost','root','','szps');
        if(!$conn){
            die(mysqli_connect_error($conn));
        }
        else{
            $sql = 'SELECT * FROM users';
            $result = mysqli_query($conn,$sql);
            if(mysqli_num_rows($result)>0){
                echo "<div class='userd'><h2>Login</h2><h2>Permission</h2><form method='post' action=''><h2>Change</h2></form></div>";
                while($row = mysqli_fetch_assoc($result)){
                    if($row['permission']=='wrk'){
                        echo "<div class='user'><h4>".$row['login']."</h4><h4>worker</h4><form method='post' action=''><input type='hidden' value='".$row['user_id']."' name='id'><input type='submit' value='Demote' name='demote' class='button f'></form></div>";
                    }
                    else if($row['permission']=='usr'){
                        echo "<div class='user'><h4>".$row['login']."</h4><h4>user</h4><form method='post' action=''><input type='hidden' value='".$row['user_id']."' name='id'><input type='submit' value='Promte' name='promote' class='button f'></form></div>";
                    }
                }
            }
        }
        ?>
        <?php
        $conn = mysqli_connect('localhost','root','','szps');
        if(!$conn){
            die(mysqli_connect_error($conn));
        }
        if(isset($_POST['promote'])){
            $sql = "UPDATE users set permission='wrk' WHERE user_id=".$_POST['id'];
            mysqli_query($conn,$sql);
        }
        if(isset($_POST['demote'])){
            $sql = "UPDATE users set permission='usr' WHERE user_id=".$_POST['id'];
            mysqli_query($conn,$sql);
        }
        ?>
    </div>
</body>
</html>