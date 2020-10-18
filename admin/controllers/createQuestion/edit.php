<?php
    $xtp = new XTemplate("views/createQuestion/edit.html");
    if($_GET['id']){
        $id = $_GET['id'];
    }
    $tbl = $db->fetchAll("SELECT * FROM  tblquestion WHERE ques_id = $id");
    foreach($tbl as $r){
        $xtp->assign('EDIT',$r);
    }
    
    if($_POST){
        $question = $_POST['ques_text'];
        $sql = "UPDATE tblquestion SET 
            ques_text = '$question'
            WHERE ques_id = {$id}
        ";
        if($db->executeSQL($sql)){
            $f->redir("../../createQuestion/list/");
        }

    }


    $xtp->parse('EDIT');
    $acontent = $xtp->text('EDIT');


?>