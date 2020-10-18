<?php
    include("../libs/bootstrap.php");
    $axtp = new XTemplate("views/login.html");
    $_SESSION['admin_signin_email']='';
    $do_login = 0;
    if($_POST){
        $email = $_POST['ad_email'];
        $pwd = $_POST['ad_password'];
        $sql = "SELECT * FROM tbladmin
        ";
        $rsUser = $db->fetchAll($sql);
        if($email=='' || $pwd ==''){
            ?><script>alert("You have not typed email or password")</script><?php
        }
        if(count($rsUser)>0){
            $pwd = sha1($pwd);
            $pwd = "{$pwd}{$salt}";
            foreach($rsUser as $r){
                if($r['ad_email'] == $email && $r['ad_password'] == $pwd){
                    $_SESSION['admin_signin_role']  = $r['role_id'];
                    $_SESSION['admin_signin_email'] = $email;
                    $do_login=1;
                    break;
                }
            }
            $role_name = $db->fetchOne("SELECT role_name FROM tblrole WHERE role_id = {$_SESSION['admin_signin_role']}");
        }
        if($do_login==0){
            ?><script>alert("Your email or password is invalid")</script><?php
        }
        if(strlen($_SESSION['admin_signin_email']) > 0){
            $f->redir("../createQuiz/list/");
        }
    }
    $axtp->parse('LOGIN');
    $axtp->out('LOGIN');