<?php
    $_SESSION['admin_signin_email'] = '';
    $_SESSION['admin_signin_name'] = '';
    session_destroy();
    if($_SESSION['admin_signin_email'] == ''){
        header("Location:login/");
    }
    ?>