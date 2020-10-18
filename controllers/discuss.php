<?php
    $xtp = new XTemplate("views/discuss.html");
    $id = $_GET['id'];

    if($_POST){
        $email = $_SESSION['user_email'];
        $sql = "SELECT user_id FROM tblusers WHERE user_email = '$email'";
        $cusId = ($db->fetchAll($sql))[0]['user_id'];
        $comment = $_POST['comment_text'];
        $sql = "INSERT INTO tblcomments(comment_text,user_id,ques_id) VALUES('$comment',$cusId,$id)";
        $db->executeSQL($sql);
    }

    $sql = "SELECT * FROM tblquestion q 
            INNER JOIN tblusers u ON q.user_id = u.user_id 
            WHERE q.ques_id = $id
            ORDER BY q.ques_id ASC" ;
    $tbl = $db->fetchAll($sql);
    
    foreach($tbl as $r){
        $xtp->assign('LIST',$r);
        $xtp->parse('DISCUSS.LIST');
    }

    $sql = "SELECT * FROM tblcomments c 
        INNER JOIN tblquestion q ON q.ques_id = c.ques_id
        INNER JOIN tblusers u ON u.user_id = c.user_id
        WHERE q.ques_id = $id
        ORDER BY q.ques_id ASC" ;
    $tbl = $db->fetchAll($sql);
    $count = count($tbl);
    $xtp->assign('count',$count);
    foreach($tbl as $r){
        $xtp->assign('COMMENT',$r);
        $xtp->parse('DISCUSS.COMMENT');
    }

    $xtp->parse('DISCUSS');
    $acontent = $xtp->text('DISCUSS');