<?php
    $xtp = new XTemplate("views/community.html");

    $sql = "SELECT * FROM tblquestion q 
            INNER JOIN tblusers u ON q.user_id = u.user_id 
            ORDER BY ques_id ASC" ;
    $tbl = $db->fetchAll($sql);
    foreach($tbl as $r){
        $xtp->assign('LIST',$r);
        $xtp->parse('COMM.LIST');
    }
    $xtp->parse('COMM');
    $acontent = $xtp->text('COMM');