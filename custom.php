<?php
function alert($message){
    if(isset($message) && !empty($message)) {
        // Display the alert message
        echo "<div class='alert'>";
        echo "<span class='closebtn' onclick='this.parentElement.style.display=\"none\";'><img src='./icons/close.svg'></span>";
        echo "<h2>$message</h2>";
        echo "</div>";
    }
}
?>