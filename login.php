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
    <div  id="form">
        <form action="" method="post">
            <span>
                <input type="text" name="login" class="input_style" placeholder="Login">
                <input type="password" name="password" class="input_style" placeholder="Password"> 
            </span>
            <span>
                <input type="submit" name = "In" value="Sign In" class="button f">
                <input type="submit" name = "Up" value="Sign Up" class="button b"> 
            </span>
        </form>
        <?php
    //from filled?
    if(isset($_POST['login']) && isset($_POST['password'])){
        $login = $_POST['login'];
        $password = $_POST['password'];
        
        if(isset($_POST['Up'])){
            
            $conn = mysqli_connect('localhost','root','','szps');
            
            if(!$conn){
                die(mysqli_connect_error($conn));
            }            
            else{
                $check_sql = "SELECT * FROM users WHERE login='$login'";
                $check_result = mysqli_query($conn,$check_sql);
                if(mysqli_num_rows($check_result)>0){
                    echo "<h4>Login already taken</h4>";
                }
                else{
                    $sql = "INSERT INTO `users`(`login`, `password`, `permission`) VALUES ('$login','".md5($password)."','usr')";
                    $result = mysqli_query($conn,$sql);
                    echo "<h4>Succesfully signed up</h4>";
                    mysqli_close($conn);
                }
            }
        }
        
        
        
        elseif(isset($_POST['In'])){
            
            $conn = mysqli_connect('localhost','root','','szps');
            
            if(!$conn){
                die(mysqli_connect_error($conn));
            }        
            else{
                $check_sql = "SELECT * FROM users WHERE login='$login' AND password = '".md5($password)."'";
                $check_result = mysqli_query($conn,$check_sql);
                if(mysqli_num_rows($check_result)>0){
                    echo "<h4>Logged in</h4>";
                    $row = mysqli_fetch_assoc($check_result);
                    
                    $_SESSION['Permission'] = $row['permission'];
                    $_SESSION['IsLogged'] = 1;
                    $_SESSION['Id'] = $row['user_id'];
                    
                    header('Location: ./index.php');
                }
            }
        }
    }
    ?>
    </div>
</body>
</html>