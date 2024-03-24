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
        <!-- Sign Out -->
        <?php
            if(isset($_POST['Out'])){
                $_SESSION['Permission'] = null;
                $_SESSION['IsLogged'] = 0;
                $_SESSION['Id'] = null;
            }        
        ?>
        <!-- Forms -->
        <?php
            if(!isset($_SESSION['IsLogged'])||$_SESSION['IsLogged']==0){
                echo '<div  id="form" class="notLogged">';
                echo '<form action="" method="post">';
                echo '<span>';
                echo '<input type="text" name="login" class="input_style" placeholder="Login">';
                echo '<input type="password" name="password" class="input_style" placeholder="Password"> ';
                echo '</span>';
                echo '<span>';
                echo '<input type="submit" name = "In" value="Sign In" class="button f">';
                echo '<input type="submit" name = "Up" value="Sign Up" class="button b"> ';
                echo '</span>';
                echo '</form>';
            }
            elseif($_SESSION['IsLogged']==1){
                echo '<div  id="form" class="logged">';
                if(isset($_POST['Change'])){
                    echo '<form action="" method="post" class="change">';
                    echo '<span>';
                    echo '<input type="password" name="oldPassword" class="input_style" placeholder="Current Password">';
                    echo '<input type="password" name="newPassword" class="input_style" placeholder="New Password"> ';
                    echo '</span>';
                    echo '<span class="horizontal">';
                    echo '<input type="submit" name = "Changed" value="Change" class="button f">';
                    echo '<input type="submit" name="Cancel" value="Cancel" class="button b">';

                    echo '</span>';
                    echo '</form>';
                }
                else{
                    echo '<h4>Hello '.$_SESSION['Account']['login'].'</h4>';
                    echo '<span>';
                    echo '<form action="" method="post">';
                    echo '<input type="submit" name = "Change" value="Change Password" class="text">';
                    echo '</form>';
                    echo '<form action="" method="post" id="LogForm">';
                    echo '<input type="submit" name = "Out" value="Sign Out" class="button f">';
                    echo '</form>';
                    echo '</span>';
                }
            }
        ?>
        <!-- Sign up and Sign in -->
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
                            $_SESSION['Account'] = ['id'=>$row['user_id'],'login'=>$row['login']];

                            header('Location: ./index.php');
                        }
                        else{
                            echo "<h4>Login or password are wrong</h4>";
                            $_SESSION['Permission'] = null;
                            $_SESSION['IsLogged'] = 0;
                            $_SESSION['Id'] = null;
                        }
                    }
                }
            }
            if(isset($_POST['oldPassword'])&&isset($_POST['newPassword'])){
                if(isset($_POST['Changed'])){
                    echo"<h4>Password Changed</h4>"; //temporary
                }
            }
        ?>
    </div>
</body>
</html>