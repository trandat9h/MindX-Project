<?php
    include("libs/bootstrap.php");
    $axtp = new XTemplate('views/layout.html');
    $m = $_GET['m'];
    if(isset($_GET['a'])){
        $a = $_GET['a'];
        if(file_exists("controllers/{$m}/{$a}.php")){
            include("controllers/{$m}/{$a}.php");
        }else{
            $acontent = '404 Not found Module/Action';
        }
        $axtp->assign('x','../');
    }
    else{
        if(file_exists("controllers/{$m}.php")){
                include("controllers/{$m}.php");
        }else{
            $acontent = '404 Not found Module/Action';
        }

    }
    if($_SESSION['user_email'] != '') $axtp->assign('logedIn',1);
    else $axtp->assign('logedIn',0);
    $axtp->assign('content',$acontent);
    $axtp->parse('LAYOUT');
    $axtp->out('LAYOUT');