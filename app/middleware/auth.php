<?php
    if(!isset($_SESSION['user']) && !$_SESSION['user']){
        header("Location:login.php");
    }
?>