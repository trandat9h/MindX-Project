<?php
    $_SESSION['user_email'] = '';
    session_destroy();
    if($_SESSION['user_email'] == ''){
        header("Location:login.php");
    }
    ?>