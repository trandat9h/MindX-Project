<?php
    $xtp = new XTemplate("views/createQuestion/list.html");

    if($_POST){
        $question = $_POST['ques_text'];
        $sql = " INSERT INTO tblquestion(ques_text) VALUES('$question') ";
        $db->executeSQL($sql);

    }
    $sql = "SELECT * FROM tblquestion";
    $tbl = $db->fetchAll($sql);
    foreach($tbl as $r){
        $xtp->assign('LIST',$r);
        $xtp->parse('QUES.LIST');
    }
    $xtp->parse('QUES');
    $acontent = $xtp->text('QUES');